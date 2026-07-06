<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = DB::table('videos')
        ->select('*')
        ->get();
        return view('pages.video',compact('videos'));

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

    function videoStatuschange(Request $request)
    {
        // dd($request);
        $status=$request -> status;
        $uid=$request -> prid;
        $imageuid=$request -> varanid;
        $statusresult = "";
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
         $imagercount = DB::table('videos')
            ->select('id')
            ->where('id',$uid)
            ->where('varan_id', '=', $imageuid)
            ->where('video_status', '=', '2')
            ->get()->count();
     
               if($status == 2)
      {
   
     $delete=DB::table('videos')->where('id', $uid)->delete();
         if($delete){
             
           
         }
      }else{
        $updatedata= DB::table('videos')->where('id',$uid)->update(array(
                                 'video_status'=>$status,

     ));
      }

      
     if($status == 0)
     {
         $statusresult = "Your Video Approval is Pending";
     }
     elseif ($status == 1) {
         $statusresult = "Your Video is Approved";
     }
     else
     {
         $statusresult = "Your Video is Rejected";
        if($imagercount == "0"){
          date_default_timezone_set("Asia/Kolkata"); 
                            $datetime = date('Y-m-d h:i:s');
                            $updatedata= DB::table('user_package')->where('user_varan_id',$imageuid)
                            ->where('validity_date', '>=', $datetime)
                            ->where('status','=','0')
                            ->update(array(
                                 'no_of_video_upload'=>DB::raw('no_of_video_upload-1'),
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
            return redirect('/videos')->with('success',' Status Updated');
        }
    }
    
    public function approvedvideofil(){
        $videos = DB::table('videos')
        ->select('*')
        ->where('video_status','1')
        ->get();
        
        return view('pages.video',compact('videos'));
    }
}


