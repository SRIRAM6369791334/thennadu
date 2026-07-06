<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



use App\Models\register;
use App\Models\otp;
use App\Models\Partner;
use App\Models\Caste;
use App\Models\Subcaste;

class registerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $register = register::all();

        return view('pages.profiles', compact('register'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $caste = Caste::all();
        $subcaste = Subcaste::all();
        $country = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $city = DB::table('cities')->get();
        $education = DB::table('eductiondetails_tb')->get();
        $job = DB::table('jobdescription_tb')->get();
        $mor_ton = DB::table('mor_ton')->get();
        $btype_tb = DB::table('btype_tb')->get();
        $complexion = DB::table('complexion_tb')->get();
        $phy_tb = DB::table('phy_tb')
            ->select('*')
            ->where('id', '!=', 0)
            ->get();
        $height = DB::table('height_tb')->get();
        $matrial_tb = DB::table('matrial_tb')->get();
        $regli_tb = DB::table('regli_tb')->get();
        $rasi_tb = DB::table('rasi_tb')->get();
        $star_db = DB::table('star')->get();
        $income_tb = DB::table('income_tb')->get();
        $job_country = DB::table('job_country')->get();

        return view('pages.create-profile', compact('caste', 'subcaste', 'country', 'states', 'city', 'education', 'job', 'mor_ton', 'btype_tb', 'complexion', 'phy_tb', 'height', 'matrial_tb', 'regli_tb', 'rasi_tb', 'star_db', 'income_tb', 'job_country'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'mobile_no' => 'required',
            'email_id' => 'required|email|unique:registers,email_id',
            'password' => 'required',
            'Gender' => 'required',
            'dob' => 'required',
        ]);

        $month = date('m');
        $year = date('y');
        
        $defaulttvalue = 11110;
        $maxValue = DB::table('registers')->max('id');
        $invID = ($defaulttvalue) + ($maxValue + 1);
        $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);
        $MatId = "TN" . $year . $month . $invID;

        $dob = $request->dob;
        $age = date("Y") - date("Y", strtotime($dob));

        $store = new register;
        $store->varan_id = $MatId;
        $store->created_for = $request->created_for;
        $store->looking_for = ($request->Gender == 1) ? 2 : 1;
        $store->Name = $request->Name;
        $store->Gender = $request->Gender;
        $store->mobile_no = $request->mobile_no;
        $store->email_id = $request->email_id;
        $store->password = $request->password;
        $store->dob = $request->dob;
        $store->age = $age;
        $store->Monther_tongue = $request->Monther_tongue;
        $store->Religion = $request->Religion;
        $store->Caste = $request->Caste;
        $store->sub_caste = $request->sub_caste;
        
        // Basic Details
        $store->height = $request->height;
        $store->marital_status = $request->marital_status;
        $store->physical_status = $request->physical_status;
        $store->body_type = $request->body_type;
        $store->complexion = $request->complexion;
        $store->no_of_children = $request->no_of_children;
        $store->eating_habit = $request->eating_habit;

        // Education & Profession
        $store->eduction = $request->eduction;
        $store->eduction_detail = $request->eduction_detail;
        $store->job_category = $request->job_category;
        $store->job_detail = $request->job_detail;
        $store->annual_income = $request->annual_income;
        $store->job_country = $request->job_country;
        $store->job_state = $request->job_state;
        $store->job_city = $request->job_city;
        $store->job_location = $request->job_location;

        // Location
        $store->country = $request->country;
        $store->state = $request->state;
        $store->district = $request->district;
        $store->municipality_panchayat = $request->municipality_panchayat;
        $store->com_address = $request->com_address;
        $store->residential_address = $request->residential_address;

        // Family
        $store->father_name = $request->father_name;
        $store->father_occuption = $request->father_occuption;
        $store->mother_name = $request->mother_name;
        $store->mother_occuption = $request->mother_occuption;
        $store->total_sibblings = $request->total_sibblings;
        $store->elder_sister = $request->elder_sister;
        $store->younger_sister = $request->younger_sister;
        $store->elder_brother = $request->elder_brother;
        $store->younger_brother = $request->younger_brother;

        // Horoscope
        $store->rasi = $request->rasi;
        $store->laknam = $request->laknam;
        $store->stars = $request->stars;
        $store->birth_time = $request->birth_time;
        $store->dosam = $request->dosam;
        $store->blood_group = $request->blood_group;
        $store->about_myself = $request->about_myself;

        $store->status = 1; // Auto approve admin entry
        $store->save();

        // Partner Preferences Initial Entry
        $store1 = new Partner;
        $store1->varan_id = $MatId;
        $store1->preference_religion = $request->Religion;
        $store1->preference_caste = $request->Caste;
        $store1->preference_subcaste = $request->sub_caste;
        $store1->save();

        // Image Handling
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $MatId . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

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
            'message' => 'Candidate ID: ' . $MatId . '<br>Password: ' . $request->password,
            'id' => $MatId,
            'password' => $request->password
        ]);
    }

    public function getCast($religion_id)
    {
        $castes = DB::table('castes')
            ->select('id', 'Caste_name as name')
            ->where('religion', $religion_id)
            ->get();
        return response()->json($castes);
    }

    public function getSubCast($caste_id)
    {
        $subcastes = DB::table('subcastes')
            ->select('id', 'subcategory_name as name')
            ->where('Category_name', $caste_id)
            ->get();
        return response()->json($subcastes);
    }

    public function getStars($rasi_id)
    {
        $stars = DB::table('rasi_star')
            ->join('star', 'rasi_star.star_id', '=', 'star.id')
            ->where('rasi_star.rasi_id', $rasi_id)
            ->select('star.id', 'star.name')
            ->get();
        return response()->json($stars);
    }

    public function getStates($country_id)
    {
        $states = DB::table('states')
            ->select('id', 'state_id', 'state_name as name')
            ->where('country_id', $country_id)
            ->get();
        return response()->json($states);
    }

    public function getCities($state_id)
    {
        $cities = DB::table('cities')
            ->select('city_id as id', 'city_name as name')
            ->where('state_id', $state_id)
            ->get();
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function storeData(Request $request)
    {

        $store = new register;

        $rules = array(
            "created_for" => 'required',
            "looking_for" => 'required',
            'Name' => 'required',
            'Gender' => 'required',
            'Monther_tongue' => 'required',
            'Religion' => 'required',
            'mobile_no' => 'required',
            'email_id' => 'required',
            'password' => 'required',
            'Caste' => 'required',
            'sub_caste' => 'required',
            'dob' => 'required',
            'age' => 'required',
            "mobileno_code" => 'required',

        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $phoneno = $request->mobile_no;
            $store->created_for = $request->created_for;
            $store->looking_for = $request->looking_for;
            $store->Name = $request->Name;
            $store->Gender = $request->Gender;
            $store->Monther_tongue = $request->Monther_tongue;
            $store->Religion = $request->Religion;
            $store->mobile_no = $request->mobile_no;
            $store->email_id = $request->email_id;
            $store->password = $request->password;
            $store->Caste = $request->Caste;
            $store->sub_caste = $request->sub_caste;
            $store->dob = $request->dob;
            $store->age = $request->age;
            $store->mobileno_code = $request->mobileno_code;

            $savedata = $store->save();

            $code = rand(1000, 10000);
            $phone = $phoneno;

            //   require_once('sendsms/sendsms.php');
            $username = "pepzop";

            //Enter your login password
            $password = "Pepzop@123";

            //Enter your text message
            $message = "Your Thennadu Login verfication OTP code is $code - Thennadu";


            //Enter your Sender ID
            $sender = "Thennadu";

            //Enter your receiver mobile number
            $mobile_number = $phone;

            //Don't change below code use as it is
            //  $url="http://app.msgpedia.com/http-api.php?authentic-key=36347065707a6f703635371643438399&username=".urlencode($username)."&password=".urlencode($password)."&senderid=".urlencode($sender)."&route=2&number=".urlencode($mobile_number)."&message=".urlencode($message)."&templateid=1207164265907030288";


            // $ch = curl_init($url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $curl_scraped_page = curl_exec($ch);
            // curl_close($ch);




            if ($savedata) {

                $conn = new otp;
                $conn->mobile_no = $phone;
                $conn->otp = $code;
                $savedata1 = $conn->save();
                if ($savedata) {
                    return response()->json([

                        'status' => '200',
                        'message' => 'Register Successfully',
                        'phoneno' => $phoneno,



                    ]);
                }
            } else {
                return ["Result" => "Data Not Saved"];
            }
        }
    }

    function otpstore(Request $request)
    {

        $phoneno = $request->mobile_no;
        $register = DB::table('registers')
            ->select('mobile_no')
            ->where('mobile_no', '=', $phoneno)
            ->get()->count();

        if ($register == 0) {


            $store = new otp;
            date_default_timezone_set("Asia/Kolkata");
            $datetime = date('Y-m-d h:i:s');
            $datetime = date('Y-m-d H:i:s', strtotime('+30 second', strtotime($datetime)));
            $rules = array(
                "otp" => 'required',
                "mobile_no" => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $validator->errors();
            } else {

                $code = rand(1000, 10000);




                $username = "pepzop";

                //Enter your login password
                $password = "Pepzop@123";

                //Enter your text message
                $message = "Your Thennadu Login verfication OTP code is $code - Thennadu";


                //Enter your Sender ID
                $sender = "Thennadu";

                //Enter your receiver mobile number
                $mobile_number = $phoneno;

                //Don't change below code use as it is
                //  $url="http://app.msgpedia.com/http-api.php?authentic-key=36347065707a6f703635371643438399&username=".urlencode($username)."&password=".urlencode($password)."&senderid=".urlencode($sender)."&route=2&number=".urlencode($mobile_number)."&message=".urlencode($message)."&templateid=1207164265907030288";


                // $ch = curl_init($url);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // $curl_scraped_page = curl_exec($ch);
                // curl_close($ch);


                $store->otp = $code;
                $store->mobile_no = $request->mobile_no;
                $store->date_time = $datetime;
                $savedata = $store->save();

                if ($savedata) {
                    return response()->json([

                        'status' => '200',
                        'message' => 'Otp Send Successfully',
                        'phoneno' => $phoneno

                    ]);
                } else {
                    return ["Result" => "Data Not Saved"];
                }
            }
        } else {

            return response()->json([

                'status' => '201',
                'message' => 'Mobile No Already Exist',
                'phoneno' => $phoneno

            ]);
        }
    }

    function otpcheck(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $month = date('m');
        $year = date('y');
        $id = $request->otp;
        $pno = $request->mobile_no;
        $register = DB::table('otp_db')
            ->select('otp')
            ->where('otp', '=', $id)
            ->where('mobile_no', '=', $pno)
            ->where('date_time', '>=', $datetime)
            ->get()->count();
        // print($register);
        // exit;

        if ($register >= 1) {

            $store = new register;
            $store1 = new Partner;

            $rules = array(
                "created_for" => 'required',
                "looking_for" => 'required',
                'Name' => 'required',
                'Gender' => 'required',
                'Monther_tongue' => 'required',
                'Religion' => 'required',
                'mobile_no' => 'required',
                'email_id' => 'required',
                'password' => 'required',
                'Caste' => 'required',
                'sub_caste' => 'required',
                'dob' => 'required',
                'age' => 'required',
                "mobileno_code" => 'required',

            );

            $defaulttvalue = 11110;
            $invID = 0;
            $maxValue = DB::table('registers')->max('id');
            $invID = ($defaulttvalue) + ($maxValue + 1);
            $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);

            $MatId = "TN" . $year . $month . $invID;
            // print($MatId);
            // exit;

            $dob = $request->dob;

            $age = date("Y") - date("Y", strtotime($dob));

            $name = $request->Name;

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $validator->errors();
            } else {

                $store->created_for = $request->created_for;
                $store->looking_for = $request->looking_for;
                $store->Name = $request->Name;
                $store->Gender = $request->Gender;
                $store->Monther_tongue = $request->Monther_tongue;
                $store->Religion = $request->Religion;
                $store->mobile_no = $request->mobile_no;
                $store->email_id = $request->email_id;
                $store->password = $request->password;
                $store->Caste = $request->Caste;
                $store->sub_caste = $request->sub_caste;
                $store->dob = $request->dob;
                $store->age = $age;
                $store->mobileno_code = $request->mobileno_code;
                $store->varan_id = $MatId;
                $savedata = $store->save();

                $store1->varan_id = $MatId;
                $store1->preference_religion = $request->Religion;
                $store1->preference_caste = $request->Caste;
                $store1->preference_subcaste = $request->sub_caste;
                $savedata1 = $store1->save();



                if ($savedata1) {
                    $status = "0";
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date('Y-m-d');
                    $package  = DB::table('offers')->where('from_date', '<=', $datetime)->where('to_date', '>=', $datetime)->first();
                    //  get PackageDetials
                    if ($package) {
                        $packagename = $package->offer_name;
                        $packageamount = "0";
                        $noofimage = $package->no_of_videos;
                        $noofvideo = $package->no_of_images;
                        $noofmobileno = $package->noofmblno;
                        $validity = $package->validity;

                        date_default_timezone_set("Asia/Kolkata");
                        $datetime = date('Y-m-d h:i:s');
                        $expiredate = date('Y-m-d H:i:s', strtotime('+' . $validity . ' days', strtotime($datetime)));

                        //  package -id

                        $invID = 0;
                        $maxValue = DB::table('user_package')->max('id');
                        $invID = $maxValue + 1;
                        $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);

                        $PackId = "Pack-" . $invID;

                        $updatedata = DB::table('user_package')->insert(
                            ['user_varan_id' => $MatId, 'package_name' => $packagename, 'package_price' => $packageamount, 'no_of_video' => $noofvideo, 'no_of_image' => $noofimage, 'no_of_phno' => $noofmobileno, 'validity_date' => $expiredate, 'enable_chat' => 'yes', 'enable_horoschope' => 'yes', 'payment_status' => 'Pending', 'payment_id' => $PackId]
                        );

                        if ($updatedata) {
                            $status = "1";
                            $updatedata1 = DB::table('registers')->where('varan_id', $MatId)
                                ->update(array(
                                    'member_shiptype' => '1',
                                ));
                        }
                    }

                    return response()->json([

                        'status' => '200',
                        'message' => 'Register Successfully',
                        'Varanid' => $MatId,
                        'age' => $age,
                        'Name' => $name,

                        DB::table('admin_notifications')->insert([
                            'title' => 'New User',
                            'description' => $name . "Registered",
                            'varan_id' => $MatId,
                            'notification_view' => 0,
                        ])
                    ]);
                } else {
                    return ["Result" => "Data Not Saved"];
                }
            }
        } else {

            return response()->json([

                'status' => '201',
                'message' => 'Invalid OTP',


            ]);
        }
    }

    function updateself(Request $request)
    {
        $varanid = $request->varan_id;
        $about_myself = $request->about_myself;
        $updatedata = DB::table('registers')->where('varan_id', $varanid)->update(array(
            'about_myself' => $about_myself,
        ));
        if ($updatedata) {
            return response()->json([

                'status' => '200',
                'message' => 'Update Successfully',
                'Varanid' => $varanid,

            ]);
        } else {
            return ["Result" => "Data Not Saved"];
        }
    }

    function updatebasic(Request $request)
    {
        $varanid = $request->varan_id;
        $name = $request->Name;
        $body_type = $request->body_type;
        $physical_status = $request->physical_status;
        $complexion = $request->complexion;
        $dob = $request->dob;
        $age = $request->age;
        $height = $request->height;
        $marital_status = $request->marital_status;
        $no_of_children = $request->no_of_children;
        $Gender = $request->Gender;
        $mobile_no = $request->mobile_no;
        $whatsapp_no = $request->whatsapp_no;
        $email_id = $request->email_id;

        $updatedata = DB::table('registers')->where('varan_id', $varanid)->update(array(
            'Name' => $name,
            'body_type' => $body_type,
            'physical_status' => $physical_status,
            'complexion' => $complexion,
            'dob' => $dob,
            'age' => $age,
            'height' => $height,
            'marital_status' => $marital_status,
            'no_of_children' => $no_of_children,
            'Gender' => $Gender,
            'mobile_no' => $mobile_no,
            'whatsapp_no' => $whatsapp_no,
            'email_id' => $email_id,
        ));
        if ($updatedata) {
            return response()->json([

                'status' => '200',
                'message' => 'Update Successfully',
                'Varanid' => $varanid,

            ]);
        } else {
            return ["Result" => "Data Not Saved"];
        }
    }

    function updatereligion(Request $request)
    {
        $varanid = $request->varan_id;
        $Religion = $request->Religion;
        $Caste = $request->Caste;
        $sub_caste = $request->sub_caste;
        $updatedata = DB::table('registers')->where('varan_id', $varanid)->update(array(
            'Religion' => $Religion,
            'Caste' => $Caste,
            'sub_caste' => $sub_caste,

        ));
        if ($updatedata) {
            return response()->json([

                'status' => '200',
                'message' => 'Update Successfully',
                'Varanid' => $varanid,

            ]);
        } else {
            return ["Result" => "Data Not Saved"];
        }
    }

    function updatelocation(Request $request)
    {
        $varanid = $request->varan_id;
        $com_address = $request->com_address;
        $country = $request->country;
        $state = $request->state;
        $district = $request->district;
        $municipality_panchayat = $request->municipality_panchayat;
        $other_countryaddress = $request->other_countryaddress;
        $residential_address = $request->residential_address;
        $updatedata = DB::table('registers')->where('varan_id', $varanid)->update(array(
            'com_address' => $com_address,
            'country' => $country,
            'state' => $state,
            'district' => $district,
            'municipality_panchayat' => $municipality_panchayat,
            'other_countryaddress' => $other_countryaddress,
            'residential_address' => $residential_address,
        ));
        if ($updatedata) {

            return response()->json([
                'status' => '200',
                'message' => 'Update Successfully',
                'Varanid' => $varanid,

            ]);
        } else {
            return ["Result" => "Data Not Saved"];
        }
    }

    function updateeduction(Request $request)
    {
        $varanid = $request->varan_id;
        $eduction = $request->eduction;
        $eduction_detail = $request->eduction_detail;
        $job_category = $request->job_category;
        $job_detail = $request->job_detail;
        $job_country = $request->job_country;
        $job_state = $request->job_state;
        $job_city = $request->job_city;
        $job_location = $request->job_location;
        $annual_income = $request->annual_income;

        $updatedata = DB::table('registers')->where('varan_id', $varanid)->update(array(
            'eduction' => $eduction,
            'eduction_detail' => $eduction_detail,
            'job_category' => $job_category,
            'job_state' => $job_state,
            'job_city' => $job_city,
            'job_location' => $job_location,
            'job_detail' => $job_detail,
            'annual_income' => $annual_income,
        ));
        if ($updatedata) {

            return response()->json([
                'status' => '200',
                'message' => 'Update Successfully',
                'Varanid' => $varanid,

            ]);
        } else {
            return ["Result" => "Data Not Saved"];
        }
    }

    function updatefamily(Request $request)
    {
        $varanid = $request->varan_id;
        $father_name = $request->father_name;
        $father_occuption = $request->father_occuption;
        $mother_name = $request->mother_name;
        $mother_occuption = $request->mother_occuption;
        $total_sibblings = $request->total_sibblings;
        $elder_sister = $request->elder_sister;
        $younger_sister = $request->younger_sister;
        $elder_brother = $request->elder_brother;
        $younger_brother = $request->younger_brother;

        $updatedata = DB::table('registers')->where('varan_id', $varanid)->update(array(
            'father_name' => $father_name,
            'father_occuption' => $father_occuption,
            'mother_name' => $mother_name,
            '`mother_occuption`' => $mother_occuption,
            'total_sibblings' => $total_sibblings,
            'elder_sister' => $elder_sister,
            'younger_sister' => $younger_sister,
            'elder_brother' => $elder_brother,
            'younger_brother' => $younger_brother,
        ));
        if ($updatedata) {

            return response()->json([
                'status' => '200',
                'message' => 'Update Successfully',
                'Varanid' => $varanid,

            ]);
        } else {
            return ["Result" => "Data Not Saved"];
        }
    }


    function updatehoroscope(Request $request)
    {

        $varanid = $request->varan_id;
        $rasi = $request->rasi;
        $laknam = $request->laknam;
        $stars = $request->stars;
        $birth_time = $request->birth_time;


        $updatedata = DB::table('registers')->where('varan_id', $varanid)->update(array(
            'rasi' => $rasi,
            'laknam' => $laknam,
            'stars' => $stars,
            'birth_time' => $birth_time,

        ));
        if ($updatedata) {

            return response()->json([
                'status' => '200',
                'message' => 'Update Successfully',
                'Varanid' => $varanid,

            ]);
        } else {
            return ["Result" => "Data Not Saved"];
        }
    }


    //  Insert patner_prefence

    function patnerpreference(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $id = $request->otp;
        $pno = $request->mobile_no;
        $register = DB::table('otp_db')
            ->select('otp')
            ->where('otp', '=', $id)
            ->where('mobile_no', '=', $pno)
            ->where('date_time', '>=', $datetime)
            ->get()->count();
        // print($register);
        // exit;

        if ($register >= 1) {

            $store = new register;

            $rules = array(
                "created_for" => 'required',
                "looking_for" => 'required',
                'Name' => 'required',
                'Gender' => 'required',
                'Monther_tongue' => 'required',
                'Religion' => 'required',
                'mobile_no' => 'required',
                'email_id' => 'required',
                'password' => 'required',
                'Caste' => 'required',
                'sub_caste' => 'required',
                'dob' => 'required',
                'age' => 'required',
                "mobileno_code" => 'required',

            );
            $invID = 0;
            $maxValue = DB::table('registers')->max('id');
            $invID = $maxValue + 1;
            $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);

            $MatId = "TN" . $invID;
            // print($MatId);
            // exit;

            $dob = $request->dob;

            $age = date("Y") - date("Y", strtotime($dob));

            $name = $request->Name;

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $validator->errors();
            } else {

                $store->created_for = $request->created_for;
                $store->looking_for = $request->looking_for;
                $store->Name = $request->Name;
                $store->Gender = $request->Gender;
                $store->Monther_tongue = $request->Monther_tongue;
                $store->Religion = $request->Religion;
                $store->mobile_no = $request->mobile_no;
                $store->email_id = $request->email_id;
                $store->password = $request->password;
                $store->Caste = $request->Caste;
                $store->sub_caste = $request->sub_caste;
                $store->dob = $request->dob;
                $store->age = $age;
                $store->mobileno_code = $request->mobileno_code;
                $store->varan_id = $MatId;
                $savedata = $store->save();



                if ($savedata) {
                    return response()->json([

                        'status' => '200',
                        'message' => 'Register Successfully',
                        'Varanid' => $MatId,
                        'age' => $age,
                        'Name' => $name,

                    ]);
                } else {
                    return ["Result" => "Data Not Saved"];
                }
            }
        } else {

            return response()->json([

                'status' => '201',
                'message' => 'Invalid OTP',


            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $register = register::find($id);
        $varanid = $register->varan_id;
        $current_date = date("Y-m-d H:i:s");
        // $current_time = date("h:i:s");
        // dd($varanid);
        $viewid = DB::table('registers')
            ->select('registers.Name', 'registers.age', 'registers.varan_id', 'registers.dob', 'registers.Gender', 'images.image_name', 'regli_tb.religion_name', 'registers.email_id', 'registers.mobile_no', 'registers.varan_id', 'registers.no_of_children', 'registers.whatsapp_no', 'registers.eating_habit', 'registers.com_address', 'registers.municipality_panchayat', 'registers.other_countryaddress', 'registers.residential_address', 'registers.aadhaar_no', 'subcastes.subcategory_name', 'subcastes.Category_name', 'registers.eduction_detail', 'registers.job_detail', 'jobdescription_tb.name', 'castes.Caste_name', 'phy_tb.phy_name', 'btype_tb.btype', 'complexion_tb.com_name', 'height_tb.height_name', 'matrial_tb.matrial_name', 'countries.country_name', 'states.state_name', 'cities.city_name', 'eductiondetails_tb.name as eduname', 'registers.annual_income', 'income_tb.salary', 'registers.father_name', 'registers.father_occuption', 'registers.mother_name', 'registers.mother_occuption', 'registers.total_sibblings', 'registers.elder_sister', 'registers.younger_sister', 'registers.elder_brother', 'registers.younger_brother', 'registers.about_myself', 'rasi_tb.name as rasi', 'lak_tb.name as lakna', 'star.name as star', 'registers.dosam', 'registers.birth_time', 'registers.blood_group', 'videos.video_name', 'horoscopes.img_name as horo_img', 'horoscopes.title as horo_title', 'user_package.package_name', 'user_package.status', 'user_package.validity_date', 'user_package.no_of_image', 'user_package.no_of_image_upload', 'job_country.country_name as jobcountry', 'job_state.state_name as jobstate', 'job_city.job_city_name as jobcity', 'users.name as brokername', 'registers.brokerid', 'user_package.created_at as package_start')
            ->leftJoin('subcastes', 'registers.sub_caste', '=', 'subcastes.id')
            ->leftJoin('jobdescription_tb', 'registers.job_category', '=', 'jobdescription_tb.id')
            // ->leftJoin('images','registers.varan_id','=','images.varanid')
            ->leftJoin('images', function ($query) {
                $query->on('registers.varan_id', '=', 'images.varanid')
                    // 	->where('images.approve_status','<>','0')
                    ->where('images.image_status', '=', 'Main');
            })
            ->leftJoin('regli_tb', 'registers.Religion', '=', 'regli_tb.id')
            ->leftJoin('castes', 'registers.Caste', '=', 'castes.id')
            ->leftJoin('phy_tb', 'registers.physical_status', '=', 'phy_tb.id')
            ->leftJoin('btype_tb', 'registers.body_type', '=', 'btype_tb.id')
            ->leftJoin('complexion_tb', 'registers.complexion', '=', 'complexion_tb.id')
            ->leftJoin('height_tb', 'registers.height', '=', 'height_tb.id')
            ->leftJoin('matrial_tb', 'registers.marital_status', '=', 'matrial_tb.id')
            ->leftJoin('countries', 'registers.country', '=', 'countries.country_id')
            ->leftJoin('states', 'registers.state', '=', 'states.state_id')
            ->leftJoin('cities', 'registers.district', '=', 'cities.city_id')
            ->leftJoin('rasi_tb', 'registers.rasi', '=', 'rasi_tb.id')
            ->leftJoin('rasi_tb as lak_tb', 'registers.laknam', '=', 'lak_tb.id')
            ->leftJoin('star', 'registers.stars', '=', 'star.id')
            ->leftJoin('eductiondetails_tb', 'registers.eduction', '=', 'eductiondetails_tb.id')
            ->leftJoin('income_tb', 'registers.annual_income', '=', 'income_tb.id')
            ->leftJoin('job_country', 'registers.job_country', '=', 'job_country.country_id')
            ->leftJoin('job_state', 'registers.job_state', '=', 'job_state.state_id')
            ->leftJoin('job_city', 'registers.job_city', '=', 'job_city.job_city_id')
            // ->leftJoin('user_package','registers.varan_id','=','user_package.user_varan_id')
            ->leftJoin('user_package', function ($query) {
                $query->on('registers.varan_id', '=', 'user_package.user_varan_id')
                    ->where('user_package.status', '=', '0');
            })
            ->leftJoin('videos', 'registers.varan_id', '=', 'videos.varan_id')
            // ->leftJoin('horoscopes','registers.varan_id','=','horoscopes.varan_id')
            ->leftJoin('horoscopes', function ($query) {
                $query->on('registers.varan_id', '=', 'horoscopes.varan_id')
                    ->where('horoscopes.title', '=', 'Horoscope');
            })
            ->leftjoin('users', 'registers.brokerid', '=', 'users.broker_id')
            ->where('registers.varan_id', '=', $varanid)->first();

        // Base URL for website assets from .env
        $mainUrl = rtrim(env('MAIN_URL'), '/') . '/uploads';

        // Fetch all images for gallery
        $all_images = DB::table('images')
            ->where('varanid', $varanid)
            ->get();

        // Fetch selfie image specifically
        $selfie = $all_images->where('image_status', 'Selfie')->first();
        if (!$selfie) {
            $selfie = $all_images->filter(function($img) {
                return stripos($img->image_name, 'selfie') !== false;
            })->first();
        }

        $no_of_img = $viewid->no_of_image;
        $no_of_upload = $viewid->no_of_image_upload;
        $result = $no_of_img - $no_of_upload;
        
        $partners = DB::table('partners')
        ->select(
            'heightfrom.height_name as height_from', 
            'heightto.height_name as height_to', 
            'partners.age_from', 
            'partners.age_to', 
            'partners.preference_bodytypetext', 
            'partners.preference_complexiontext', 
            'partners.marital_statustext', 
            'partners.preference_educattext', 
            'partners.preference_jobcattext', 
            'regli_tb.religion_name as preference_religion_name',
            'castes.Caste_name as preference_caste_name',
            'subcastes.subcategory_name as preference_subcaste_name',
            'partners.preference_religiontext', 
            'partners.preference_castetext', 
            'partners.preference_subcastetext', 
            'partners.preference_countrytext', 
            'partners.preference_statetext', 
            'partners.preference_districttext',
            'partners.preference_eating',
            'pref_income.salary as preference_income'
        )
        ->leftJoin('height_tb as heightfrom', 'partners.preference_height', '=', 'heightfrom.id')
        ->leftJoin('height_tb as heightto', 'partners.preference_heightto', '=', 'heightto.id')
        ->leftJoin('regli_tb', 'partners.preference_religion', '=', 'regli_tb.id')
        ->leftJoin('castes', 'partners.preference_caste', '=', 'castes.id')
        ->leftJoin('subcastes', 'partners.preference_subcaste', '=', 'subcastes.id')
        ->leftJoin('income_tb as pref_income', 'partners.preference_income', '=', 'pref_income.id')
        ->where('partners.varan_id', '=', $varanid)->first();
        
        $datetime = date('Y-m-d h:i:s');
        $packcnt = DB::table('user_package')
        ->where('user_varan_id', $varanid)
        ->where('validity_date', '>=', $datetime)
        ->where('status','=','0')
        ->orderBy('id','DESC')
        ->count();
        $bioviewcount = 0;
        $totalbioviewed = 0;
        
        // $totalycount = 0;
        $totalycount = DB::table('vieweds')->where('uservaran_id', $varanid)->count();
        if($packcnt == 1){
        
            $packdet = DB::table('user_package')
            ->where('user_varan_id', $varanid)
            ->where('validity_date', '>=', $datetime)
            ->where('status','=','0')
            ->orderBy('id','DESC')
            ->first();
            
            $bioviewcount = $packdet->no_of_phno;
            $totalbioviewed = $packdet->no_of_phno_viewed;
        }

        // dd($register);

        return view('pages.view-profile', compact('register', 'viewid', 'current_date', 'result', 'partners', 'bioviewcount', 'totalbioviewed', 'totalycount', 'selfie', 'all_images', 'mainUrl'));
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
    public function update(Request $request)
    {
        $uid = $request->id;
        $rasi = $request->rasi;
        $laknam = $request->laknam;
        $stars = $request->stars;
        $birth_time = $request->birth_time;
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


    function getData($id = null)
    {

        $data = register::get();
        return response()->json([
            "data" => $data
        ], 200);

        // return $id?register::find($id):register::all();

    }


    // Kesavan

    function statusChange(Request $request)
    {
        // dd($request);
        $status = $request->status;
        $uid = $request->prid;
        // dd($uid);
        $getmblnum = DB::table('registers')
            ->select('*')
            ->where('varan_id', '=', $uid)
            ->first();

        $mblnum = $getmblnum->mobile_no;
        $statusresult = "";
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $updatedata = DB::table('registers')->where('varan_id', $uid)->update(array(
            'status' => $status,

        ));
        if ($status == 0) {
            $statusresult = "Your Account Approval is Pending";
        } elseif ($status == 1) {
            $statusresult = "Your Account is Approved";

            if ($updatedata) {
                $token = "bed7a88d1e7d19be53ad8553dcee1cfc";
                $credit = "2";
                $sender = "VARANF";
                $mobile_number = $mblnum;
    
                //Enter your text message
                $message = "Your Profile was successfully Verified & Approved. Regards, VARANF";
    
                $url = "http://sms.saitechnosolutions.net/sendsms/?token=bed7a88d1e7d19be53ad8553dcee1cfc&credit=2&sender=" . urlencode($sender) . "&message=" . urlencode($message) . "&number=" . urlencode($mobile_number);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);
                
                return redirect('/profiles')->with('success', ' Status Updated');
            }
            // $url="http://sms.saitechnosolutions.net/sendsms/?token=87c13d427e12b47a9f6535878483d96a&credit=3&sender=".urlencode($sender)."&message=".urlencode($message)."&number=".urlencode($mobile_number)."&templateid=1707165060409453778";
            // dd($url);

        } else if($status == 2) {
            $statusresult = "Your Account is Rejected";
            
    
            
            if ($updatedata) {
                $token = "bed7a88d1e7d19be53ad8553dcee1cfc";
                $credit = "2";
                $sender = "VARANF";
                $mobile_number = $mblnum;
    
                //Enter your text message
                $message = "We regret that your profile has been rejected as per the Varan Terms and Conditions. Please reach out to our customer support for further details. Regards, VARANF";
    
                $url = "http://sms.saitechnosolutions.net/sendsms/?token=bed7a88d1e7d19be53ad8553dcee1cfc&credit=2&sender=" . urlencode($sender) . "&message=" . urlencode($message) . "&number=" . urlencode($mobile_number);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);
                
                return redirect('/profiles')->with('success', ' Status Updated');
            }
        }
        DB::table('notifications')->insert([
            'Title' => 'Approval Status',
            'description' => $statusresult,
            'varan_id' => $uid,
            'created_at' => $datetime,
        ]);


        
    }

    function brokerStatusChange(Request $request)
    {
        // dd($request);
        $status = $request->status;
        $uid = $request->prid;
        $statusresult = "";
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        $updatedata = DB::table('users')->where('broker_id', $uid)->update(array(
            'broker_approval_status' => $status,

        ));
        if ($status == 0) {
            $statusresult = "Your Account Approval is Pending";
        } elseif ($status == 1) {
            $statusresult = "Your Account is Approved";
        } else {
            $statusresult = "Your Account is Rejected";
        }
        DB::table('notifications')->insert([
            'Title' => 'Approval Status',
            'description' => $statusresult,
            'varan_id' => $uid,
            'created_at' => $datetime,
        ]);


        if ($updatedata) {

            return redirect('/brokers')->with('success', ' Status Updated');
        }
    }

    function newprofiles()
    {

        $data = DB::table('registers')
            ->leftJoin('images', function($join) {
                $join->on('registers.varan_id', '=', 'images.varanid')
                     ->where('images.image_status', '=', 'Main');
            })
            ->select('registers.*', 'images.image_name')
            ->where('registers.status', '0')
            ->where(function($query) {
                $query->where('registers.blockstatus', '0')
                      ->orWhereNull('registers.blockstatus');
            })
            ->get();
        $mainUrl = rtrim(env('MAIN_URL'), '/') . '/uploads';
        return view('pages.newprofiles', ['data' => $data, 'mainUrl' => $mainUrl]);
    }

    function premiumprofiles()
    {

        $data = DB::table('registers')
            ->select('*')
            ->where('member_shiptype', '=', '1')
            ->get();
        return view('pages.premiumprofiles', ['data' => $data]);
    }

    function brokerprofiles()
    {
        $loginuser = Auth::user()->broker_id;

        $data1 = DB::table('registers')
            ->where('brokerid', $loginuser)
            ->get();

        if ($data1) {
            return view('pages.brokersview', ['data1' => $data1]);
        }
    }

    public function getdeleterecords()
    {
        $deleterecord = DB::table('registers')
            ->select('*')
            ->where('delete_setting', '!=', '')
            ->get();

        return view('pages.deleterecord', compact('deleterecord'));
    }

    public function deletestatuschange(Request $request)
    {
        $status = $request->status;
        $uid = $request->prid;
        $statusresult = "";
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d h:i:s');
        if ($status == 'Approve') {
            $updatedata = DB::table('registers')->where('varan_id', $uid)->update(array(
                'delete_setting' => $status,
                'status' => 0,
            ));
        } else {
            $updatedata = DB::table('registers')->where('varan_id', $uid)->update(array(
                'delete_setting' => $status,
                'status' => 1,
            ));
        }

        return redirect('/deleterecord')->with('success', ' Status Updated');
    }

    public function profilefilter($id)
    {

        if ($id == '1') {
            $register = DB::table('registers')
                ->select('*')
                ->where('status', '1')
                ->get();
        } elseif ($id == '2') {
            $register = DB::table('registers')
                ->select('*')
                ->where([['status', '0'], ['blockstatus', '0']])
                ->get();
        } elseif ($id == '3') {
            $register = DB::table('registers')
                ->select('*')
                ->where('blockstatus', '1')
                ->get();
        }
        return view('pages.profiles', compact('register'));
    }

    public function Blockstatus(Request $request)
    {
        $blockstatus = $request->blockstatus;
        $varanid = $request->prid;
        
        $getmblnum = DB::table('registers')
            ->select('*')
            ->where('varan_id', '=', $varanid)
            ->first();

        $mblnum = $getmblnum->mobile_no;

        // $statusresult = "";
        // date_default_timezone_set("Asia/Kolkata");
        // $datetime = date('Y-m-d h:i:s');

        if ($blockstatus == 1) {
            $bstatus = DB::table('registers')
                ->where('varan_id', $varanid)
                ->update([
                    'status' => '0',
                    'blockstatus' => '1'
                ]);
            
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
            
            return redirect()->back()->with('success', 'Profile has been blocked');
        } elseif ($blockstatus == 2) {
            $bstatus = DB::table('registers')
                ->where('varan_id', $varanid)
                ->update([
                    'status' => '1',
                    'blockstatus' => '0'
                ]);
            return redirect()->back()->with('success', 'Profile has been unblocked');
        }
    }
}


