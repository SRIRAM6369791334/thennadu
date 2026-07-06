<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caste;
use App\Models\Subcaste;
use Illuminate\Support\Facades\DB;
use App\Models\register;
use App\Models\User;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;


class BrokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caste = Caste::all();
        $subcaste = Subcaste::all();
        $country = DB::table('countries')->where('country_id','<>','0')->get();
        $states = DB::table('states')->where('state_id','<>','0')->get();
        $city = DB::table('cities')->where('city_id','<>','0')->get();
        $education = DB::table('eductiondetails_tb')->get();
        $job = DB::table('jobdescription_tb')->get();
        $mor_ton = DB::table('mor_ton')->get();
        $btype_tb = DB::table('btype_tb')->get();
        $complexion = DB::table('complexion_tb')->get();
        $phy_tb = DB::table('phy_tb')
        ->select('*')
        ->where('id','!=',0)
        ->get();
        $height = DB::table('height_tb')->get();
        $matrial_tb = DB::table('matrial_tb')->get();
        $regli_tb = DB::table('regli_tb')->get();
        $rasi_tb = DB::table('rasi_tb')->get();
        $star_db = DB::table('star')->get();
        $income_tb = DB::table('income_tb')->get();
        $work_count = DB::table('job_country')->get();
        $work_state = DB::table('job_state')->get();
        $work_city = DB::table('job_city')->get();


        return view('pages.create_profile',compact('caste','subcaste','country','states','city','education','job','mor_ton','btype_tb','complexion','phy_tb','height','matrial_tb','regli_tb','rasi_tb','star_db','income_tb','work_count','work_state','work_city'));
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
        $rules = array(
            //  'aadhaar_number' => 'required|unique:registers,aadhaar_no|min:12|max:12',
             'mobile_no' => 'required|unique:registers,mobile_no|min:10|max:10'
        );
        
        $validator = Validator::make($request->all(),$rules);

        if($validator -> fails())
        {
           return redirect()->back()->withErrors($validator->errors());
        }
        
        $mobile_no = $request->input('mobile_no');
        
        $phone = DB::table('registers')
        ->select('*')
        ->where('mobile_no','=',$mobile_no)
        ->get()->count();
        
        if($phone == 0){
        
        $broker = new register;
        $store1 = new Partner;
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $month = date('m');
        $year =date('y');
        $broker->created_for = $request->input('createdfor');
        $broker->Name = $request->input('fullname');
        $broker->Gender = $request->input('gender');
        if($request->input('gender') == 'Male'){
            $broker->looking_for = 2;
        }else if($request->input('gender') == 'Female'){
            $broker->looking_for = 1;
        }
        
        $broker->dob = $request->input('dob');
        
        $diff = (date('Y') - date('Y',strtotime($request->input('dob'))));
        
        $broker->age = $diff;
        
        $broker->email_id = $request->input('email');
        $broker->mobile_no = $request->input('mobile_no');
        $broker->Monther_tongue = $request->input('mothertongue');
        $broker->body_type = $request->input('bodytype');
        $broker->physical_status = $request->input('physicalstatus');
        $broker->complexion = $request->input('complexion');
        $broker->height = $request->input('height');
        $broker->marital_status = $request->input('maritalstatus');
        $broker->Religion = $request->input('religion');
        $broker->Caste = $request->input('caste');
        $broker->sub_caste = $request->input('subcaste');
        $broker->com_address = $request->input('address');
        $broker->country = $request->input('country');
        $broker->state = $request->input('state');
        $broker->district = $request->input('city');
        $broker->eduction = $request->input('education');
        $broker->eduction_detail = $request->input('educationdetail');
        $broker->job_category = $request->input('jobs');
        $broker->job_detail = $request->input('jobdetail');
        $broker->job_country = $request->input('jobcountry');
        $broker->job_state = $request->input('jobstate');
        $broker->job_city = $request->input('jobcity');
        $broker->annual_income = $request->input('annalincone');
        $broker->father_name = $request->input('fathername');
        $broker->father_occuption = $request->input('fatherjob');
        $broker->mother_name = $request->input('mothername');
        $broker->mother_occuption = $request->input('motherjob');
        $broker->total_sibblings = $request->input('noofsibling');
        $broker->elder_sister = $request->input('noofeldersister');
        $broker->younger_sister = $request->input('noofyoungersister');
        $broker->elder_brother = $request->input('noofelderbrother');
        $broker->younger_brother = $request->input('noofyoungerbrother');
        $broker->rasi = $request->input('zodiac');
        $broker->laknam = $request->input('laknam');
        $broker->stars = $request->input('stars');
        $broker->birth_time = $request->input('birthtime');
        $broker->dosam = $request->input('dhosam');
        $broker->password = $request->input('password');
        if($request->input('brokerid') != null && $request->input('brokerid') != ''){
            $broker->brokerid = $request->input('brokerid');
        }else{
           $broker->brokerid = 0; 
        }
        // $broker->aadhaar_no = $request->aadhaar_number;
        $broker->mobileno_code = "+91";
        $defaulttvalue = 11110;
            $invID =0;
            $maxValue = DB::table('registers')->max('id');
            $invID=($defaulttvalue)+($maxValue+1);
            $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);

            $MatId="V".$year.$month.$invID;

        $broker->varan_id = $MatId;
        
        $broker->save();
        
        $store1->varan_id=$MatId;
        $store1->preference_religion=$request->input('religion');
        $store1->preference_caste=$request->input('caste');
        $store1->preference_subcaste=$request->input('subcaste');
        $savedata1 = $store1->save();
        
        $status="0";
        date_default_timezone_set("Asia/Kolkata"); 
        $datetime = date('Y-m-d');            
        $package  = DB::table('offers')->where('from_date','<=', $datetime)->where('to_date','>=', $datetime)->first();
        
           //  get PackageDetials
        if($package){
            $packagename=$package->offer_name;
            $packageamount="0";
            $noofimage=$package->no_of_images;
            $noofvideo=$package->no_of_videos;
            $noofmobileno=$package->noofmblno;
            $validity=$package->validity;
            $chatt = $package->specification_3;
            $enable_call = $package->specification_4;
            $advancesearch = $package->specification_5;
         
            date_default_timezone_set("Asia/Kolkata"); 
            $datetime = date('Y-m-d h:i:s');
            $expiredate = date('Y-m-d H:i:s',strtotime('+'.$validity.' days',strtotime($datetime)));
        
            //  package -id 
        
            $invID =0;
            $maxValue = DB::table('user_package')->max('id');
            $invID=$maxValue+1;
            $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);
         
            $PackId="Pack-".$invID;
         
            $updatedata= DB::table('user_package')->insert(
	            ['user_varan_id' => $MatId, 'package_name' => $packagename, 'package_price' => $packageamount, 'no_of_video' => $noofvideo, 'no_of_image' => $noofimage, 'no_of_phno' => $noofmobileno, 'validity_date' => $expiredate, 'enable_chat' => $chatt, 'enable_call' => $enable_call, 'enable_horoschope' => 'yes', 'enable_advancesearch' => $advancesearch, 'payment_status' => 'Pending','payment_id' => $PackId,'status' => 0, 'created_at' => $datetime ]);
	
            if($updatedata){
                $status="1";  
                $updatedata1= DB::table('registers')->where('varan_id',$MatId)
                ->update(array(
                    'member_shiptype'=>'1',
                ));     
            }
        }
        
        $token = "bed7a88d1e7d19be53ad8553dcee1cfc";
        $credit = "2";
        $sender = "VARANF";
        $mobile_number = $request->input('mobile_no');
    
        //Enter your text message
        $message = "Thanks for being with us, your profile has been created. Our Varan team will validate the data and revert to you in case of any quarries. Regards VARANF";
    
        $url = "http://sms.saitechnosolutions.net/sendsms/?token=bed7a88d1e7d19be53ad8553dcee1cfc&credit=2&sender=" . urlencode($sender) . "&message=" . urlencode($message) . "&number=" . urlencode($mobile_number);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        
        // IMAGE UPLOAD HANDLING
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $MatId . '.' . $image->getClientOriginalExtension();
            
            // Save to the main site's uploads folder so it can be displayed there
            // Resolves the path relative to the project root for local development
            $uploadsPath = env('MAIN_SITE_UPLOADS', '../../matrimony/public/uploads');
            $destinationPath = (strpos($uploadsPath, ':\\') !== false || strpos($uploadsPath, '/') === 0) 
                ? $uploadsPath 
                : base_path($uploadsPath);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);

            DB::table('images')->insert([
                'varanid' => $MatId,
                'image_name' => $imageName,
                'image_status' => 'Main',
                'approve_status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect('/profiles')->with('success_modal', [
            'title' => 'Profile Created Successfully',
            'message' => 'Candidate ID: ' . $MatId . '<br>Password: ' . $request->input('password'),
            'id' => $MatId,
            'password' => $request->input('password')
        ]);
        
        }
        // else{
        //     return redirect('/broker')->with('mobile_error','Mobile Number already exist');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        $brokerid = $data->broker_id;
        $brokerpasswd = $data->showpasswd;
        // dd($brokerpasswd);
        // $payments = DB::statement( DB::raw("SELECT SUM(payment_amount) as totalamt,validity from payments where broker_id = '$brokerid' and payment_status = 'Success'") );
        $payments = DB::table('payments')
        ->select(DB::raw("SUM(payment_amount) as totalamt"), 'validity')
        ->where('broker_id','=',$brokerid)
        ->where('payment_status','=','Success')
        ->where('broker_paid_status','=','')
        ->first();
        // ->get();

        $paymenthistory = DB::table('payment_history')
        ->where('broker_id',$brokerid)
        ->get();


        return view('pages.view-broker',compact('data','payments','paymenthistory','brokerpasswd'));
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

    function sendpaymentreq(Request $request)
    {
        $brokerid = $request->brokerid;
        $earnedamt = $request->earnedamt;
        date_default_timezone_set("Asia/Kolkata");
        $payment_req_data = date('Y-m-d h:i:s');
        $updatepayment= DB::table('users')->where('broker_id',$brokerid)->update(array(
            'earned_amt'=>$earnedamt,
            'payment_req_data'=>$payment_req_data,
        ));

        DB::table('payment_history')->insert([
            'earned_amt' => $earnedamt,
            'req_date' => $payment_req_data,
            'earned_amt_status' => 'Pending',
            'amt_paid_date' => 'Pending',
            'broker_id'=> $brokerid

         ]);

        if($updatepayment)
        {
            return back()->with('success',"Your payment Request Send Successfully...");

        }
    }


    function paidstatuschange(Request $request)
    {

        $paidstatus = $request->paidstatus;
        $paiddate = $request->paiddate;
        $brokerid = $request->brokerid;



        $updatedata = DB::table('payments')->where('broker_id',$brokerid)->update(array(
            'broker_paid_status'=>'paid',
        ));

       DB::table('payment_history')->where('broker_id',$brokerid)->update(array(
            'earned_amt_status'=>$paidstatus,
            'amt_paid_date'=>$paiddate,
        ));

        // $updatedata = DB::table('users')->where('broker_id',$brokerid)->update(array(
        //     'earned_amt'=>'',
        //     'payment_req_data'=>'',
        // ));
        if($updatedata)
        {
            return back()->with('success',"Payment Status Updated");
        }

    }
}


