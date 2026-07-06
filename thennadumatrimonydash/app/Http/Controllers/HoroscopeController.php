<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horoscope;
use Illuminate\Support\Facades\DB;


class HoroscopeController extends Controller
{
        function savehoro(Request $request){

                  if($request->hasFile('image')) {
            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);

        }
         $store = new Horoscope;
         $store ->img_name = $name;
         $store ->varan_id= $request->varid;
         $store ->title= $request->title;
         $savedata = $store->save();
         if($savedata)
                 {
        return response()->json([
            asset("images/$name"),
            201,
            'message' => asset("images/$name") ? 'Horo saved' : 'Image failed to save'
        ]);

                 }

    }

    public function index()
    {
        $horoscopeimages = Horoscope::all();
        return view('pages.horoscopeimg',compact('horoscopeimages'));
    }

    function horoscopeStatuschange(Request $request)
    {
        // dd($request);
        $status=$request -> status;
        $uid=$request -> prid;
        $imageuid=$request -> varanid;
        $statusresult = "";
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $imagercount = DB::table('horoscopes')
            ->select('id')
            ->where('id',$uid)
            ->where('varan_id', '=', $imageuid)
            ->where('approval_status', '=', '2')
            ->get()->count();
     
               if($status == 2)
      {
   
     $delete=DB::table('horoscopes')->where('id', $uid)->delete();
         if($delete){
             
           
         }
      }else{
         $updatedata= DB::table('horoscopes')->where('id',$uid)->update(array(
                                 'approval_status'=>$status,

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
                                 'no_of_horo_upload'=>DB::raw('no_of_horo_upload+1'),
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
                                 'no_of_horo_upload'=>DB::raw('no_of_horo_upload-1'),
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
            return redirect('/horoscopeimg')->with('success',' Status Updated');
        }
    }

    public function approveprofileimg()
    {
        $horoscopeimages = DB::table('horoscopes')
        ->where('approval_status',1)
        ->get();

        return view('pages.approvehoroscopeimg',compact('horoscopeimages'));
    }

    public function pendingprofileimg()
    {
        $horoscopeimages = DB::table('horoscopes')
        ->where('approval_status',0)
        ->get();

        return view('pages.pendinghoroscopeimg',compact('horoscopeimages'));
    }

    public function approveallhoroscopeimg()
    {
        $images= DB::table('horoscopes')->where('approval_status',0)->update(array(
            'approval_status'=>1,
        ));

        return back()->with('success',"Approved All Images");
    }

}


