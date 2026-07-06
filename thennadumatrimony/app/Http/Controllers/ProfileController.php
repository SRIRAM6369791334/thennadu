<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email'  => 'required|email',
            'mobile' => 'required',
        ]);

        $mobile = $request->mobile;
        $email  = $request->email;

        // Check if mobile number is already registered
        $mobileExists = Profile::where('mobile_no', $mobile)->exists();
        if ($mobileExists) {
            return response()->json([
                'success' => false,
                'message' => 'You are already registered with this mobile number. Please login instead.',
                'mobile_exists' => true,
            ]);
        }

        // Check if email is already registered
        $emailExists = Profile::where('email_id', $email)->exists();
        if ($emailExists) {
            return response()->json([
                'success' => false,
                'message' => 'This email address is already registered. Please login instead.',
            ]);
        }

        $otp = rand(100000, 999999);

        // Store OTP and registration info in session
        Session::put('otp', $otp);
        Session::put('otp_email', $email);
        Session::put('otp_mobile', $mobile);
        Session::put('otp_verified', false);

        try {
            Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($email, $otp) {
                $message->to($email)
                    ->subject($otp . ' is your Registration OTP - Thennadu Matrimony');
            });

            return response()->json(['success' => true, 'message' => 'OTP sent successfully to ' . $email]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('OTP Send Failure: ' . $e->getMessage(), [
                'email' => $email,
                'exception' => $e
            ]);
            return response()->json([
                'success' => false, 
                'message' => 'Failed to send OTP. Error: ' . $e->getMessage() . '. Please check your SMTP configuration in .env.'
            ]);
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $sessionOtp = Session::get('otp');
        $inputOtp = $request->otp;

        if ($sessionOtp && $inputOtp == $sessionOtp) {
            Session::put('otp_verified', true);
            return response()->json(['success' => true, 'message' => 'OTP verified successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP. Please try again.']);
    }

    public function store(Request $request)
    {
        // 0. Check OTP Verification
        if (!Session::get('otp_verified')) {
            return redirect()->back()->with('error', 'Please verify your email with OTP first.')->withInput();
        }

        if (Session::get('otp_email') !== $request->email) {
            return redirect()->back()->with('error', 'Email changed after verification. Please verify again.')->withInput();
        }

        // Double-check: mobile number uniqueness (server-side safety net)
        if (Profile::where('mobile_no', $request->mobile)->exists()) {
            return redirect()->back()->with('error', 'You are already registered with this mobile number. Please login instead.')->withInput();
        }

        // 1. Generate Varan ID (Matches dashboard logic)
        $year = date('y');
        $month = date('m');
        $defaulttvalue = 11110;
        $maxValue = DB::table('registers')->max('id');
        $invID = ($defaulttvalue) + ($maxValue + 1);
        $VaranId = "V" . $year . $month . $invID;

        // Check for password
        if (!$request->filled('password')) {
            return redirect()->back()->with('error', 'A password is required to secure your account.')->withInput();
        }

        // 2. Map and Prepare Data
        $dob = $request->dob;
        $age = Carbon::parse($dob)->age;

        if ($age < 18) {
            return redirect()->back()->with('error', 'You must be at least 18 years old to register.')->withInput();
        }

        $gender = ucfirst($request->gender);
        $lookingFor = ($gender == 'Male') ? 2 : 1;
        $userToken = bin2hex(random_bytes(30));

        $profileData = [
            'varan_id' => $VaranId,
            'created_for' => $request->profile_for,
            'looking_for' => $lookingFor,
            'Name' => $request->full_name,
            'mobile_no' => $request->mobile,
            'email_id' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $dob,
            'age' => $age,
            'Gender' => $gender,
            'height' => $request->height,
            'body_type' => $request->body_type,
            'complexion' => $request->complexion,
            'blood_group' => $request->blood_group,
            'physical_status' => $request->physical_status,
            'marital_status' => $request->marital_status,
            'eating_habit' => $request->eating_habit,
            'Religion' => $request->religion,
            'Caste' => $request->caste,
            'sub_caste' => $request->sub_caste,
            'Monther_tongue' => $request->mother_tongue,
            'birth_time' => $request->birth_time,
            'stars' => $request->star,
            'rasi' => $request->rasi,
            'laknam' => $request->laknam,
            'dosam' => $request->dosam,
            'country' => $request->country ?? 101,
            'state' => $request->state,
            'district' => $request->city,
            'eduction' => $request->education,
            'eduction_detail' => $request->college,
            'job_category' => $request->job_category ?? 1,
            'job_detail' => $request->occupation,
            'annual_income' => $request->annual_income,
            'job_location' => $request->work_location,
            'about_myself' => $request->interests, 
            'interests' => $request->interests,
            'father_name' => $request->father_name,
            'father_occuption' => $request->father_occuption,
            'mother_name' => $request->mother_name,
            'mother_occuption' => $request->mother_occuption,
            'total_sibblings' => $request->total_sibblings ?? 0,
            'elder_sister' => $request->elder_sister ?? 0,
            'younger_sister' => $request->younger_sister ?? 0,
            'elder_brother' => $request->elder_brother ?? 0,
            'younger_brother' => $request->younger_brother ?? 0,
            'status' => 0,
            'member_shiptype' => 0,
            'user_token' => $userToken,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $profile = Profile::create($profileData);

        // 3. Create Partner Preference record (Matches dashboard flow)
        DB::table('partners')->insert([
            'varan_id' => $VaranId,
            'preference_religion' => $profileData['Religion'],
            'preference_caste' => $profileData['Caste'],
            'preference_subcaste' => $profileData['sub_caste'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 4. Handle Images (Save directly to local public/uploads folder)
        $publicImagesPath = public_path('uploads');
        if (!file_exists($publicImagesPath)) {
            mkdir($publicImagesPath, 0755, true);
        }
        
        if ($request->hasFile('profile_photo')) {
            $fileName = time() . "_" . $request->file('profile_photo')->getClientOriginalName();
            $request->file('profile_photo')->move($publicImagesPath, $fileName);
            
            DB::table('images')->insert([
                'varanid' => $VaranId,
                'image_name' => $fileName,
                'image_status' => 'Main',
                'approve_status' => 0,
                'created_at' => now()
            ]);
        }

        if ($request->filled('selfie_image')) {
            $img = $request->selfie_image;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $fileName = time() . "_selfie_" . $VaranId . ".png";
            file_put_contents($publicImagesPath . '/' . $fileName, $data);
            
            DB::table('images')->insert([
                'varanid' => $VaranId,
                'image_name' => $fileName,
                'image_status' => 'Selfie',
                'approve_status' => 0,
                'created_at' => now()
            ]);
        }

        if ($request->hasFile('horoscope_file')) {
            $horoName = time() . "_horo_" . $request->file('horoscope_file')->getClientOriginalName();
            $request->file('horoscope_file')->move($publicImagesPath, $horoName);
            
            DB::table('horoscopes')->insert([
                'varan_id' => $VaranId,
                'img_name' => $horoName,
                'title' => 'Horoscope',
                'approval_status' => 0,
                'created_at' => now()
            ]);
        }

        // 5. Admin Notification
        DB::table('admin_notifications')->insert([
            'title' => 'New User',
            'description' => $request->full_name . " Registered from Website",
            'varan_id' => $VaranId,
            'notification_view' => 0,
            'created_at' => now()
        ]);

        // 6. Auto-login
        Auth::login($profile);

        return redirect()->route('dashboard')->with('show_preference_modal', true)->with('success', 'Profile created successfully! Please set your partner preferences to see matches.');
    }
}
