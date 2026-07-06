<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Report;
use App\Models\Tracking;

class reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::all();

        return view('pages.report',compact('report'));
    }

            function savereport(Request $request){

        $store = new Report;

               $rules = array(
            "user_varan_id" => 'required',
            "report_varan_id"=>'required',
            "remarks"=>'required',


            );

        $validator = Validator::make($request->all(),$rules);

        if($validator -> fails())
        {
                return $validator -> errors();
        }
        else
        {
                $store ->user_varan_id = $request -> user_varan_id;
                $store ->report_varan_id = $request -> report_varan_id;
                $store ->remarks = $request -> remarks;
                $savedata = $store->save();

                if($savedata)
                {

                $status = "Report";

                $store1 = new Tracking;
                $store1 ->user_varan_id = $request -> user_varan_id;
                $store1 ->partner_varan_id = $request -> report_varan_id;
                $store1 ->purpose = $status;
                $savedata1 = $store1->save();
                if($savedata1)
                {
                    return response()->json([

                        'status' => '200',
                        'message' => 'Register Successfully',
                    ]);
                }
                }
                else
                {
                    return ["Result"=>"Data Not Saved"];
                }
        }



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

    public function reportstatusChange(Request $request)
    {
        // dd($request);
        $status=$request -> status;
        $uid=$request -> prid;
        $statusresult = "";
        $varanid = $request->varanid;
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $updatedata= DB::table('reports')->where('id',$uid)->update(array(
                                 'status'=>$status,

        ));
     
        $getmblnum = DB::table('registers')
            ->select('*')
            ->where('varan_id', '=', $varanid)
            ->first();

        $mblnum = $getmblnum->mobile_no;
 

     if($status == 0)
     {
         $statusresult = "Your Account Is Reported";
         $updatedata2= DB::table('registers')->where('varan_id',$varanid)->update(array(
            'status'=>1,
            'blockstatus'=>0,
    ));
     }
     elseif ($status == 1) {
         $statusresult = "Your Account is Reviewed";
         $updatedata2= DB::table('registers')->where('varan_id',$varanid)->update(array(
            'status'=>1,
            'blockstatus'=>0,
    ));
     }
     else
     {
         $statusresult = "Your Account is Terminated";
         $updatedata2= DB::table('registers')->where('varan_id',$varanid)->update(array(
            'status'=>0,
            'blockstatus'=>1,
        ));
        
                $token = "bed7a88d1e7d19be53ad8553dcee1cfc";
                $credit = "2";
                $sender = "VARANF";
                $mobile_number = $mblnum;
    
                //Enter your text message
                $message = "Your Profile has been temporarily blocked. Please reach out to our customer support for further details. Regards, VARANF";
    
                $url = "http://sms.saitechnosolutions.net/sendsms/?token=bed7a88d1e7d19be53ad8553dcee1cfc&credit=2&sender=" . urlencode($sender) . "&message=" . urlencode($message) . "&number=" . urlencode($mobile_number);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);
     }
     DB::table('notifications')->insert([
        'Title' => 'Approval Status',
        'description' => $statusresult,
        'varan_id' => $varanid,
        'created_at' =>$datetime,
     ]);


        if($updatedata)
        {
            return redirect('/report')->with('success',' Status Updated');
        }
    }
}



