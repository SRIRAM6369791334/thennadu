<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Image;

class ImageController extends Controller
{

     function saveimage(Request $request){




         $store = new Image;
        //  $rules = array(
        //      "image_name" => 'required',
        //      "varanid"=>'required',

        //  );




                  if($request->hasFile('image')) {
            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
         $store ->image_name = $name;
         $store ->varanid= $request->varid;
        $savedata = $store->save();
         if($savedata)
                 {
        return response()->json([
            asset("images/$name"),
            201,
            'message' => asset("images/$name") ? 'Image saved' : 'Image failed to save'
        ]);

                 }


    //   $outputfile = "images/" ;
    //save as image.jpg in uploads/ folder

    // $filehandler = fopen($outputfile, 'wb' );

    //  fwrite($filehandler, base64_decode($image));
    //   fclose($filehandler);
        // $image = $request->image;
        // $name = time().'.'.$image->getClientOriginalExtension();
        // $destinationPath = public_path('/images');
        // $image->move($destinationPath, $name);
        // $this->save();

        // return back()->with('success','Image Upload successfully');





        //          if($savedata)
        //          {
        //              return response()->json([

        //      'status' => '200',
        //      'message' => 'Saved Successfully',


        //  ]);
        //          }
        //          else
        //          {
        //              return ["Result"=>"Data Not Saved"];
        //          }

            // }

    }


    function imageStatuschange(Request $request)
    {
        // dd($request);
        $status=$request -> status;
        $uid=$request -> prid;
        $imageuid=$request -> varanid;
        $statusresult = "";
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $imagercount = DB::table('images')
            ->select('id')
            ->where('id',$uid)
            ->where('varanid', '=', $imageuid)
            ->where('approve_status', '=', '2')
            ->get()->count();
             if($status == 2)
      {
   
     $delete=DB::table('images')->where('id', $uid)->delete();
         if($delete){
             
              $updatedata= DB::table('images')->where('varanid',$imageuid)
              ->limit(1)
                   ->update(array(
                       'image_status'=>"Main",
                   ));
         }
      }else{
               $updatedata= DB::table('images')->where('id',$uid)->update(array(
                                'approve_status'=>$status,

     ));
      }
     if($status == 0)
     {
         $statusresult = "Your Image Approval is Pending";
     }
     elseif ($status == 1) {
         $statusresult = "Your Image is Approved";
         if($imagercount == "1"){
          date_default_timezone_set("Asia/Kolkata"); 
                            $datetime = date('Y-m-d h:i:s');
                            $updatedata= DB::table('user_package')->where('user_varan_id',$imageuid)
                            ->where('validity_date', '>=', $datetime)
                            ->where('status','=','0')
                            ->update(array(
                                 'no_of_image_upload'=>DB::raw('no_of_image_upload+1'),
                            ));
        }
     }
     else
     {
         $statusresult = "Your Image is Rejected";
          if($imagercount == "0"){
          date_default_timezone_set("Asia/Kolkata"); 
                            $datetime = date('Y-m-d h:i:s');
                            $updatedata= DB::table('user_package')->where('user_varan_id',$imageuid)
                            ->where('validity_date', '>=', $datetime)
                            ->where('status','=','0')
                            ->update(array(
                                 'no_of_image_upload'=>DB::raw('no_of_image_upload-1'),
                       ));
          }

     }

    $updatedata2 = DB::table('notifications')->insert([
        'Title' => 'Approval Status',
        'description' => $statusresult,
        'varan_id' => $imageuid,
        'created_at' =>$datetime,
        'imagesid' => $uid
     ]);

        if($updatedata2)
        {
            
             
            return redirect('/profile-images')->with('success',' Status Updated');
        }
    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return view('pages.profileImages',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approveprofileimg()
    {
        $images = DB::table('images')
        ->leftJoin('registers', 'images.varanid', '=', 'registers.varan_id')
        ->select('images.*', 'registers.Name as user_name')
        ->where('images.approve_status',1)
        ->get();

        return view('pages.approveprofileimg',compact('images'));
    }

    public function pendingprofileimg()
    {
        $images = DB::table('images')
        ->leftJoin('registers', 'images.varanid', '=', 'registers.varan_id')
        ->select('images.*', 'registers.Name as user_name')
        ->where('images.approve_status',0)
        ->get();

        return view('pages.pendingprofileimg',compact('images'));
    }

    public function approveallprofileimg()
    {
        $images= DB::table('images')->where('approve_status',0)->update(array(
            'approve_status'=>1,
        ));

        return back()->with('success',"Approved All Images");
    }
}


