<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;

use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    protected $matchService;

    public function __construct(\App\Services\MatchmakingService $matchService)
    {
        $this->matchService = $matchService;
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Check active subscription
        $activePackage = \App\Models\UserPackage::where('user_varan_id', $user->varan_id)
            ->where('status', 1)
            ->where('validity_date', '>', now())
            ->first();

        // Fetch user data from different tables
        $profile = Profile::find($user->id);

        // Resolve ID to names for profile display
        $profile->religion_name = DB::table('regli_tb')->where('id', $profile->Religion)->value('religion_name') ?? $profile->Religion;
        $profile->caste_name = DB::table('castes')->where('id', $profile->Caste)->value('Caste_name') ?? $profile->Caste;
        $profile->sub_caste_name = DB::table('subcastes')->where('id', $profile->sub_caste)->value('subcategory_name') ?? $profile->sub_caste;
        $profile->marital_status_name = DB::table('matrial_tb')->where('id', $profile->marital_status)->value('matrial_name') ?? $profile->marital_status;
        $profile->education_name = DB::table('eductiondetails_tb')->where('id', $profile->eduction)->value('name') ?? $profile->eduction;
        $profile->star_name = DB::table('star')->where('id', $profile->stars)->value('name') ?? $profile->stars;
        $profile->rasi_name = DB::table('rasi_tb')->where('id', $profile->rasi)->value('name') ?? $profile->rasi;
        $profile->laknam_name = DB::table('rasi_tb')->where('id', $profile->laknam)->value('name') ?? $profile->laknam;
        $profile->height_name = DB::table('height_tb')->where('id', $profile->height)->value('height_name') ?? $profile->height;
        $profile->job_category_name = DB::table('jobdescription_tb')->where('id', $profile->job_category)->value('name') ?? $profile->job_category;
        $profile->physical_status_name = ($profile->physical_status == 1) ? 'Normal' : (($profile->physical_status == 2) ? 'Physically Challenged' : $profile->physical_status);
        $profile->income_name = DB::table('income_tb')->where('id', $profile->annual_income)->value('salary') ?? $profile->annual_income;
        $profile->district_name = DB::table('cities')->where('city_id', $profile->district)->value('city_name') ?? $profile->district;

        $partnerExpectations = DB::table('partners')->where('varan_id', $user->varan_id)->first();
        if ($partnerExpectations) {
            $partnerExpectations->religion_name = DB::table('regli_tb')->where('id', $partnerExpectations->preference_religion)->value('religion_name') ?? 'Any';
            $partnerExpectations->caste_name = DB::table('castes')->where('id', $partnerExpectations->preference_caste)->value('Caste_name') ?? 'Any';
            $partnerExpectations->sub_caste_name = DB::table('subcastes')->where('id', $partnerExpectations->preference_subcaste)->value('subcategory_name') ?? 'Any';
            $partnerExpectations->education_name = DB::table('eductiondetails_tb')->where('id', $partnerExpectations->preference_educat)->value('name') ?? 'Any';
            $partnerExpectations->income_name = DB::table('income_tb')->where('id', $partnerExpectations->preference_income)->value('salary') ?? 'Any';
            $partnerExpectations->job_name = DB::table('jobdescription_tb')->where('id', $partnerExpectations->preference_jobcat)->value('name') ?? 'Any';
            $partnerExpectations->body_name = DB::table('btype_tb')->where('id', $partnerExpectations->preference_bodytype)->value('btype') ?? 'Any';
            $partnerExpectations->complexion_name = DB::table('complexion_tb')->where('id', $partnerExpectations->preference_complexion)->value('com_name') ?? 'Any';
        }

        $images = DB::table('images')->where('varanid', $user->varan_id)->get();
        $horoscope = DB::table('horoscopes')->where('varan_id', $user->varan_id)->first();

        // Calculate Profile Completion Percentage
        $completion = $this->calculateCompletion($profile, $images, $partnerExpectations);

        // Fetch Master Data for Dropdowns
        $religions = DB::table('regli_tb')->get();
        $castes = DB::table('castes')->where('religion', $profile->Religion)->get();
        $subcastes = DB::table('subcastes')->where('Category_name', $profile->Caste)->get();
        $marital_statuses = DB::table('matrial_tb')->get();
        $education_list = DB::table('eductiondetails_tb')->get();
        $rasis = DB::table('rasi_tb')->get();
        $stars = DB::table('star')->get();
        $heights = DB::table('height_tb')->get();
        $job_categories = DB::table('jobdescription_tb')->get();
        $income_list = DB::table('income_tb')->get();
        $body_types = DB::table('btype_tb')->get();
        $complexions = DB::table('complexion_tb')->get();
        $cities = DB::table('cities')->get();

        // Fetch real statistics from database
        $stats = [
            'views' => DB::table('trackings')->where('partner_varan_id', $user->varan_id)->where('purpose', 'Profile View')->count(),
            'interests_sent' => DB::table('interest_requests')->where('sender_id', $user->id)->count(),
            'interests_received' => DB::table('interest_requests')->where('receiver_id', $user->id)->count(),
            'active_chats' => DB::table('conversations')->where(function($q) use ($user) {
                $q->where('user_one', $user->id)->orWhere('user_two', $user->id);
            })->count(),
            'shortlisted' => DB::table('favourites')->where('user_varan_id', $user->varan_id)->count()
        ];

        // Calculate trust score dynamically
        $hasSelfie = DB::table('images')->where('varanid', $user->varan_id)->where('image_status', 'Selfie')->exists();
        $trustScore = 20; // Base score
        if (!empty($profile->email_id)) {
            $trustScore += 15;
        }
        if (!empty($profile->mobile_no)) {
            $trustScore += 15;
        }
        $trustScore += (int) round($completion * 0.3); // Up to 30%
        if ($hasSelfie) {
            $trustScore += 20;
        }

        return view('pages.dashboard', compact(
            'profile', 'partnerExpectations', 'images', 'horoscope',
            'completion', 'stats', 'religions', 'castes', 'subcastes',
            'marital_statuses', 'education_list', 'rasis', 'stars', 'heights',
            'job_categories', 'income_list', 'body_types', 'complexions', 'activePackage', 'cities',
            'trustScore'
        ));
    }

    public function chat()
    {
        return redirect()->route('chat.index');
    }

    public function matches()
    {
        $sessionUser = Auth::user();
        $images = DB::table('images')->where('varanid', $sessionUser->varan_id)->get();

        // Use Matchmaking Service (consistent with MatchController)
        $user = \App\Models\User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$user)
            return back()->with('error', 'Matchmaking account not found.');

        // Fetch all potential matches as a collection
        $allMatches = $this->matchService->getPotentialMatches($user);

        // Manual Pagination for the Collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $allMatches->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $matches = new LengthAwarePaginator(
            $currentItems,
            $allMatches->count(),
            $perPage,
            $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );

        $sentInterests = \App\Models\InterestRequest::where('sender_id', $user->id)->pluck('status', 'receiver_id');

        return view('pages.matches', compact('images', 'matches', 'sentInterests', 'user'));
    }

    public function interests()
    {
        $sessionUser = Auth::user();
        $images = DB::table('images')->where('varanid', $sessionUser->varan_id)->get();
        $user = \App\Models\User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$user)
            return back()->with('error', 'Matchmaking account not found.');

        $interestsSent = \App\Models\InterestRequest::where('sender_id', $user->id)
            ->with(['receiver.profile'])
            ->get();

        return view('pages.interests', compact('images', 'interestsSent', 'user'));
    }

    public function visitors()
    {
        $user = Auth::user();
        if (!$user)
            return redirect()->route('login');

        $images = DB::table('images')->where('varanid', $user->varan_id)->get();

        // Fetch people who visited MY profile
        $visitorIds = DB::table('trackings')
            ->where('partner_varan_id', $user->varan_id)
            ->where('purpose', 'Profile View')
            ->where('user_varan_id', '!=', $user->varan_id)
            ->distinct()
            ->pluck('user_varan_id');

        $visitors = Profile::whereIn('varan_id', $visitorIds)->get();

        return view('pages.visitors', compact('images', 'visitors'));
    }

    public function shortlist()
    {
        $user = Auth::user();
        $images = DB::table('images')->where('varanid', $user->varan_id)->get();
        return view('pages.shortlist', compact('images'));
    }

    public function viewProfile($varan_id = null)
    {
        $user = Auth::user();
        $matchUser = $user ?\App\Models\User::where('email', $user->email ?? $user->email_id)->first() : null;
        $targetVaranId = $varan_id ?? ($user ? $user->varan_id : null);

        if (!$targetVaranId) {
            return redirect()->route('login');
        }

        $profile = Profile::where('varan_id', $targetVaranId)->first();
        if (!$profile) {
            abort(404);
        }

        // Record Visitor (Tracking)
        if ($user && $user->varan_id !== $profile->varan_id) {
            DB::table('trackings')->insert([
                'user_varan_id' => $user->varan_id,
                'partner_varan_id' => $profile->varan_id,
                'purpose' => 'Profile View',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Resolve ID to names
        $profile->religion_name = DB::table('regli_tb')->where('id', $profile->Religion)->value('religion_name') ?? $profile->Religion;
        $profile->caste_name = DB::table('castes')->where('id', $profile->Caste)->value('Caste_name') ?? $profile->Caste;
        $profile->sub_caste_name = DB::table('subcastes')->where('id', $profile->sub_caste)->value('subcategory_name') ?? $profile->sub_caste;
        $profile->marital_status_name = DB::table('matrial_tb')->where('id', $profile->marital_status)->value('matrial_name') ?? $profile->marital_status;
        $profile->education_name = DB::table('eductiondetails_tb')->where('id', $profile->eduction)->value('name') ?? $profile->eduction;
        $profile->star_name = DB::table('star')->where('id', $profile->stars)->value('name') ?? $profile->stars;
        $profile->rasi_name = DB::table('rasi_tb')->where('id', $profile->rasi)->value('name') ?? $profile->rasi;
        $profile->laknam_name = DB::table('rasi_tb')->where('id', $profile->laknam)->value('name') ?? $profile->laknam;
        $profile->height_name = DB::table('height_tb')->where('id', $profile->height)->value('height_name') ?? $profile->height;
        $profile->job_category_name = DB::table('jobdescription_tb')->where('id', $profile->job_category)->value('name') ?? $profile->job_category;
        $profile->physical_status_name = ($profile->physical_status == 1) ? 'Normal' : (($profile->physical_status == 2) ? 'Physically Challenged' : $profile->physical_status);
        $profile->income_name = DB::table('income_tb')->where('id', $profile->annual_income)->value('salary') ?? $profile->annual_income;
        
        $profile->district = DB::table('cities')->where('city_id', $profile->district)->value('city_name') ?? $profile->district;
        $profile->state = DB::table('states')->where('id', $profile->state)->value('state_name') ?? $profile->state;

        $partnerExpectations = DB::table('partners')->where('varan_id', $targetVaranId)->first();
        if ($partnerExpectations) {
            $partnerExpectations->religion_name = DB::table('regli_tb')->where('id', $partnerExpectations->preference_religion)->value('religion_name') ?? 'Any';
            $partnerExpectations->caste_name = DB::table('castes')->where('id', $partnerExpectations->preference_caste)->value('Caste_name') ?? 'Any';
            $partnerExpectations->sub_caste_name = DB::table('subcastes')->where('id', $partnerExpectations->preference_subcaste)->value('subcategory_name') ?? 'Any';
            $partnerExpectations->height_name = DB::table('height_tb')->where('id', $partnerExpectations->preference_height)->value('height_name') ?? 'Any';
            $partnerExpectations->education_name = DB::table('eductiondetails_tb')->where('id', $partnerExpectations->preference_educat)->value('name') ?? 'Any';
            $partnerExpectations->income_name = DB::table('income_tb')->where('id', $partnerExpectations->preference_income)->value('salary') ?? 'Any';
            $partnerExpectations->job_name = DB::table('jobdescription_tb')->where('id', $partnerExpectations->preference_jobcat)->value('name') ?? 'Any';
            $partnerExpectations->body_name = DB::table('btype_tb')->where('id', $partnerExpectations->preference_bodytype)->value('btype') ?? 'Any';
            $partnerExpectations->complexion_name = DB::table('complexion_tb')->where('id', $partnerExpectations->preference_complexion)->value('com_name') ?? 'Any';
        }

        $images = DB::table('images')->where('varanid', $targetVaranId)->get();
        $horoscope = DB::table('horoscopes')->where('varan_id', $targetVaranId)->first();

        // Interest Status for Contact Locking
        $interest = null;
        $targetModernUser = \App\Models\User::where('user_ID', $targetVaranId)->first();
        
        if ($matchUser && $targetModernUser) {
            $interest = \App\Models\InterestRequest::where('sender_id', $matchUser->id)
                ->where('receiver_id', $targetModernUser->id)
                ->first();

            // Also check if received (mutual)
            if (!$interest) {
                $interest = \App\Models\InterestRequest::where('sender_id', $targetModernUser->id)
                    ->where('receiver_id', $matchUser->id)
                    ->first();
            }
        }

        // Subscription and Contact View status check
        $activePackage = null;
        $isContactUnlocked = false;

        if ($user) {
            $activePackage = \App\Models\UserPackage::where('user_varan_id', $user->varan_id)
                ->where('status', 1)
                ->where('validity_date', '>', now())
                ->first();

            // Check if contact already unlocked
            $isContactUnlocked = DB::table('vieweds')
                ->where('uservaran_id', $user->varan_id)
                ->where('partner_varan_id', $profile->varan_id)
                ->where('phn_num_view_status', 1)
                ->exists();
        }

        $isPremium = $activePackage ? true : false;

        // Mutual interest also unlocks (default proper flow)
        if ($interest && $interest->status == 1) {
            $isContactUnlocked = true;
        }

        // Horoscope Matching for current viewing
        $horoscopeMatch = null;
        if ($matchUser && $matchUser->user_ID !== $profile->varan_id) {
            $targetUser = \App\Models\User::where('user_ID', $profile->varan_id)->first();
            if ($targetUser) {
                $horoscopeMatch = $this->matchService->getHoroscopeMatch($matchUser, $targetUser);
            }
        }

        return view('pages.profile', compact('profile', 'partnerExpectations', 'images', 'horoscope', 'interest', 'isPremium', 'user', 'activePackage', 'isContactUnlocked', 'horoscopeMatch', 'targetModernUser'));
    }

    public function unlockContact($id)
    {
        $user = Auth::user();
        $targetProfile = Profile::findOrFail($id);

        if (!$user)
            return back()->with('error', 'Login required.');

        // Already unlocked check
        $alreadyUnlocked = DB::table('vieweds')
            ->where('uservaran_id', $user->varan_id)
            ->where('partner_varan_id', $targetProfile->varan_id)
            ->where('phn_num_view_status', 1)
            ->exists();

        if ($alreadyUnlocked)
            return back()->with('success', 'Contact was already unlocked.');

        // Check active package and balance
        $activePackage = \App\Models\UserPackage::where('user_varan_id', $user->varan_id)
            ->where('status', 1)
            ->where('validity_date', '>', now())
            ->first();

        if (!$activePackage)
            return redirect()->route('plans.index')->with('warning', 'Active subscription required to unlock contacts.');

        if ($activePackage->no_of_phno_viewed >= $activePackage->no_of_phno) {
            return redirect()->route('plans.index')->with('warning', 'Contact view limit reached for your current plan. Please upgrade.');
        }

        // Transactional update
        DB::transaction(function () use ($user, $targetProfile, $activePackage) {
            // Update seen balance
            $activePackage->increment('no_of_phno_viewed');

            // Insert into vieweds
            DB::table('vieweds')->updateOrInsert(
            ['uservaran_id' => $user->varan_id, 'partner_varan_id' => $targetProfile->varan_id],
            [
                'package_id' => $activePackage->id,
                'phn_num_view_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
            );
        });

        return back()->with('success', 'Contact details unlocked successfully!');
    }

    public function updatePartnerPreferences(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $data = $request->only([
            'age_from', 'age_to', 'preference_height', 'preference_heightto',
            'preference_religion', 'preference_caste', 'preference_subcaste',
            'preference_educat', 'preference_jobcat', 'preference_location',
            'preference_eating', 'preference_income', 'preference_bodytype', 'preference_complexion', 'marital_status'
        ]);

        $data['updated_at'] = now();

        $exists = DB::table('partners')->where('varan_id', $user->varan_id)->exists();

        if ($exists) {
            DB::table('partners')->where('varan_id', $user->varan_id)->update($data);
        }
        else {
            $data['varan_id'] = $user->varan_id;
            $data['created_at'] = now();
            DB::table('partners')->insert($data);
        }

        // Sync with modern partner_preferences table
        $modernUser = \App\Models\User::where('email', $user->email ?? $user->email_id)->first();
        if ($modernUser) {
            // Resolve IDs to names for the modern table (which MatchmakingService expects strings for)
            $relName = DB::table('regli_tb')->where('id', $request->preference_religion)->value('religion_name');
            $casteName = DB::table('castes')->where('id', $request->preference_caste)->value('Caste_name');
            $eduName = DB::table('eductiondetails_tb')->where('id', $request->preference_educat)->value('name');

            \App\Models\PartnerPreference::updateOrCreate(
            ['user_id' => $modernUser->id],
            [
                'age_from' => $request->age_from ?? 20,
                'age_to' => $request->age_to ?? 50,
                'religion' => $relName ?: null,
                'caste' => $casteName ?: null,
                'education' => $eduName ?: null,
                'location' => $request->preference_location ?: null,
                'min_income' => $request->preference_income ?: null,
                'marital_status' => $request->marital_status ?: null,
            ]
            );
        }

        return back()->with('success', 'Partner preferences updated successfully!');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('varan_id', $user->varan_id)->first();

        if (!$profile) {
            return back()->with('error', 'Profile not found.');
        }

        $data = $request->only([
            'Name', 'dob', 'marital_status', 'Monther_tongue', 'Religion', 'Caste', 'sub_caste',
            'eduction', 'job_detail', 'annual_income', 'about_myself', 'district',
            'stars', 'rasi', 'laknam', 'birth_time', 'physical_status'
        ]);

        // Update age if DOB changed
        if (isset($data['dob'])) {
            $data['age'] = \Carbon\Carbon::parse($data['dob'])->age;
        }

        $profile->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:5120']);
        $user = Auth::user();

        if ($request->hasFile('photo')) {
            $fileName = time() . "_" . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('uploads'), $fileName);

            DB::table('images')->insert([
                'varanid' => $user->varan_id,
                'image_name' => $fileName,
                'image_status' => 'Gallery', // Default to gallery, user can set to Main later
                'approve_status' => 0,
                'created_at' => now()
            ]);
        }

        return back()->with('success', 'Photo uploaded successfully!');
    }

    public function uploadSelfie(Request $request)
    {
        $request->validate(['selfie_image' => 'required|string']);
        $user = Auth::user();

        if ($request->filled('selfie_image')) {
            $img = $request->selfie_image;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $fileName = time() . "_selfie_" . $user->varan_id . ".png";

            $publicPath = public_path('uploads');
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            file_put_contents($publicPath . '/' . $fileName, $data);

            // Check if already has a selfie, if so delete old one or update
            $oldSelfie = DB::table('images')
                ->where('varanid', $user->varan_id)
                ->where('image_status', 'Selfie')
                ->first();

            if ($oldSelfie) {
                $oldPath = public_path('uploads/' . $oldSelfie->image_name);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
                DB::table('images')->where('id', $oldSelfie->id)->delete();
            }

            DB::table('images')->insert([
                'varanid' => $user->varan_id,
                'image_name' => $fileName,
                'image_status' => 'Selfie',
                'approve_status' => 0,
                'created_at' => now()
            ]);

            return response()->json(['success' => true, 'message' => 'Selfie uploaded successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to upload selfie.']);
    }

    public function setMainPhoto($id)
    {
        $user = Auth::user();

        // Remove 'Main' status from all other photos of this user
        DB::table('images')->where('varanid', $user->varan_id)->update(['image_status' => 'Gallery']);

        // Set this specific photo as Main
        DB::table('images')->where('id', $id)->where('varanid', $user->varan_id)->update(['image_status' => 'Main']);

        return back()->with('success', 'Main profile photo updated!');
    }

    public function deletePhoto($id)
    {
        $user = Auth::user();
        $image = DB::table('images')->where('id', $id)->where('varanid', $user->varan_id)->first();

        if ($image) {
            // Delete file
            $filePath = public_path('uploads/' . $image->image_name);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete record
            DB::table('images')->where('id', $id)->delete();
            return back()->with('success', 'Photo deleted successfully!');
        }

        return back()->with('error', 'Photo not found.');
    }

    public function horoscope()
    {
        $user = Auth::user();
        $images = $user ?DB::table('images')->where('varanid', $user->varan_id)->get() : collect([]);
        $my_horoscopes = $user ?DB::table('horoscopes')->where('varan_id', $user->varan_id)->get() : collect([]);

        $rasis = DB::table('rasi_tb')->get();
        $stars = DB::table('star')->get();

        return view('pages.horoscope', compact('images', 'my_horoscopes', 'rasis', 'stars'));
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

    public function checkHoroscopeMatch(Request $request)
    {
        $mRasi = $request->male_rasi;
        $mStar = $request->male_star;
        $fRasi = $request->female_rasi;
        $fStar = $request->female_star;

        $match = DB::table('horomacth_tb')
            ->where('male_rasi', $mRasi)
            ->where('male_star', $mStar)
            ->where('female_rasi', $fRasi)
            ->where('female_star', $fStar)
            ->first();

        if ($match) {
            return response()->json([
                'success' => true,
                'no_matches' => $match->no_matches,
                'status' => $match->Status,
                'status_tamil' => strtolower($match->Status) === 'ok' ? 'உத்தமம் (Best)' : 'அதமம் (Not Recommended)'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Compatibility data not found for this combination.'
        ]);
    }

    public function bookConsultation(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'message' => 'nullable|string'
        ]);

        DB::table('consultations')->insert([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email ?? (Auth::user()->email ?? Auth::user()->email_id),
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Consultation booked! Our Pandit will contact you soon.');
    }

    public function uploadHoroscope(Request $request)
    {
        $request->validate([
            'horoscope_file' => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120',
            'title' => 'nullable|string|max:255'
        ]);

        $user = Auth::user();

        if ($request->hasFile('horoscope_file')) {
            $file = $request->file('horoscope_file');
            $fileName = time() . "_horoscope_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/horoscopes'), $fileName);

            $varan_id = $user ? $user->varan_id : 'GUEST_' . time();

            DB::table('horoscopes')->insert([
                'varan_id' => $varan_id,
                'img_name' => $fileName,
                'title' => $request->title ?? 'My Horoscope',
                'directory_path' => 0,
                'approval_status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return back()->with('success', 'Horoscope uploaded successfully!');
    }

    public function deleteHoroscope($id)
    {
        $user = Auth::user();
        $query = DB::table('horoscopes')->where('id', $id);

        if ($user) {
            $query->where('varan_id', $user->varan_id);
        }

        $horoscope = $query->first();

        if ($horoscope) {
            $filePath = public_path(($horoscope->directory_path !== 'uploads/horoscopes' ? 'uploads/horoscopes' : $horoscope->directory_path) . '/' . $horoscope->img_name);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            DB::table('horoscopes')->where('id', $id)->delete();
            return back()->with('success', 'Horoscope deleted successfully!');
        }

        return back()->with('error', 'Horoscope not found or unauthorized.');
    }

    private function calculateCompletion($profile, $images, $expectations)
    {
        $totalFields = 8;
        $filledFields = 0;

        if (!empty($profile->Name))
            $filledFields++;
        if (!empty($profile->dob))
            $filledFields++;
        if (!empty($profile->stars))
            $filledFields++;
        if (!empty($profile->eduction))
            $filledFields++;
        if (!empty($profile->father_name))
            $filledFields++;
        if ($images->count() > 0)
            $filledFields++;
        if ($expectations)
            $filledFields++;
        if (!empty($profile->about_myself))
            $filledFields++;

        return round(($filledFields / $totalFields) * 100);
    }

    public function requestDelete(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'delete_reason' => 'required|string|max:255',
            'delete_reason_detail' => 'nullable|string|max:1000',
        ]);

        $reason = $request->delete_reason;
        if ($request->delete_reason === 'Other' && !empty($request->delete_reason_detail)) {
            $reason = 'Other - ' . $request->delete_reason_detail;
        } elseif (!empty($request->delete_reason_detail)) {
            $reason .= ' - ' . $request->delete_reason_detail;
        }

        $existingPending = DB::table('registers')
            ->where('varan_id', $user->varan_id)
            ->where('delete_setting', 'Pending')
            ->first();

        if ($existingPending) {
            return back()->with('error', 'You already have a pending delete request. Please wait for admin approval.');
        }

        DB::table('registers')->where('varan_id', $user->varan_id)->update([
            'delete_setting' => 'Pending',
            'delete_reason'  => $reason,
        ]);

        return redirect()->route('dashboard')->with('success', 'Your account deletion request has been sent to admin for approval.');
    }
}
