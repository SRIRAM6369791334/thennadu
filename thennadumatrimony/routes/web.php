<?php

use Illuminate\Support\Facades\Route;

use App\Models\Banner;
use App\Models\Package;
use App\Models\SuccessStory;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MatchController;
use App\Http\Controllers\InterestController;

Route::get('/', function () {
    return redirect('/register');
});

// TEMP: verify seeded data — remove after review
Route::get('/verify-seed', function () {
    $seeded = \Illuminate\Support\Facades\DB::table('registers')->orderBy('id', 'desc')->limit(50)->get();
    
    // Sync to `users` table
    foreach($seeded as $u) {
        $exists = \Illuminate\Support\Facades\DB::table('users')->where('user_ID', $u->varan_id)->exists();
        if (!$exists) {
            \Illuminate\Support\Facades\DB::table('users')->insert([
                'user_ID' => $u->varan_id,
                'name' => $u->Name,
                'email' => $u->email_id,
                'mblno' => $u->mobile_no,
                'password' => $u->password,
                'role' => 4,
                'gender' => $u->Gender,
                'dob' => $u->dob,
                'religion' => $u->Religion,
                'caste' => $u->Caste,
                'marital_status' => $u->marital_status,
                'mother_tongue' => $u->Monther_tongue,
                'district' => $u->district,
                'status' => $u->status,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    $users = \Illuminate\Support\Facades\DB::table('registers')->orderBy('id', 'desc')->limit(50)->get(['id','varan_id','Name','Gender','age','district','eduction','job_detail','Religion','Caste','email_id','mobile_no','status','created_at']);
    $totalReg = \Illuminate\Support\Facades\DB::table('registers')->count();
    $totalUsers = \Illuminate\Support\Facades\DB::table('users')->count();
    
    $html = '<style>body{font-family:sans-serif;padding:20px;background:#f5f5f5;}table{border-collapse:collapse;width:100%;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.1);}th{background:#900C3F;color:#fff;padding:10px 12px;text-align:left;font-size:13px;}td{padding:8px 12px;border-bottom:1px solid #eee;font-size:12px;}tr:hover td{background:#fff8fb;}h2{color:#900C3F;}.badge{background:#900C3F;color:#fff;padding:3px 8px;border-radius:4px;font-size:11px;}.gold{background:#D4AF37;}</style>';
    $html .= "<h2>✅ Seeded Tamil Users — Total in Registers: $totalReg | Total in Users: $totalUsers</h2>";
    $html .= '<table><thead><tr><th>#</th><th>ID</th><th>Varan ID</th><th>Name</th><th>Gender</th><th>Age</th><th>District</th><th>Education</th><th>Job</th><th>Religion - Caste</th><th>Email</th><th>Mobile</th><th>Status</th><th>Created</th></tr></thead><tbody>';
    $i = 1;
    foreach ($users as $u) {
        $g = $u->Gender === 'Male' ? '#e3f2fd' : '#fce4ec';
        $html .= "<tr style='background:$g'><td>$i</td><td>$u->id</td><td><b>$u->varan_id</b></td><td><b>$u->Name</b></td><td>$u->Gender</td><td>{$u->age} yrs</td><td>$u->district</td><td>$u->eduction</td><td>$u->job_detail</td><td>$u->Religion - $u->Caste</td><td style='font-size:11px;'>$u->email_id</td><td>$u->mobile_no</td><td>" . ($u->status ? '<span class=badge>Active</span>' : 'Pending') . "</td><td style='font-size:11px;'>" . \Carbon\Carbon::parse($u->created_at)->format('d M Y') . "</td></tr>";
        $i++;
    }
    $html .= '</tbody></table>';
    $html .= '<p style="margin-top:15px;color:#666;">Password for all users: <b>Password@123</b> | <a href="/verify-seed-delete" style="color:red;">Remove this route</a></p>';
    return $html;
});
Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy'); })->name('privacy.policy');
Route::get('/terms', function () {
    return view('pages.terms'); })->name('terms');
Route::get('/safety-tips', function () {
    return view('pages.safety-tips'); })->name('safety.tips');

Route::get('/home', function (\App\Services\MatchmakingService $matchService) {
    $banners = Banner::where('status', true)->orderBy('order')->get();
    $stories = SuccessStory::orderBy('married_date', 'desc')->get();

    $user = Auth::user();
    $profiles = collect();

    if ($user) {
        $matchUser = \App\Models\User::where('email', $user->email ?? $user->email_id)->first();
        if ($matchUser) {
            $profiles = $matchService->getPotentialMatches($matchUser, ['intensity' => 70])->take(4);
        }
    } else {
        // For guests, show recent active profiles
        $profiles = \App\Models\User::where('status', 1)
            ->where('role', 'user')
            ->latest()
            ->take(4)
            ->get();
    }

    $packages = Package::where('package_status', 1)->get();

    return view('pages.home', compact('banners', 'stories', 'profiles', 'packages'));
});
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/chat', [\App\Http\Controllers\DashboardController::class, 'chat'])->name('dashboard.chat')->middleware('auth');
Route::get('/dashboard/matches', [\App\Http\Controllers\DashboardController::class, 'matches'])->name('dashboard.matches')->middleware('auth');
Route::get('/dashboard/interests', [InterestController::class, 'index'])->name('dashboard.interests')->middleware('auth');
Route::get('/dashboard/visitors', [\App\Http\Controllers\DashboardController::class, 'visitors'])->name('dashboard.visitors')->middleware('auth');
Route::get('/dashboard/shortlist', [\App\Http\Controllers\DashboardController::class, 'shortlist'])->name('dashboard.shortlist')->middleware('auth');
Route::post('/dashboard/partner-preferences', [\App\Http\Controllers\DashboardController::class, 'updatePartnerPreferences'])->name('dashboard.partner.update')->middleware('auth');
Route::post('/dashboard/profile-update', [\App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('dashboard.profile.update')->middleware('auth');
Route::post('/dashboard/photo-upload', [\App\Http\Controllers\DashboardController::class, 'uploadPhoto'])->name('dashboard.photo.upload')->middleware('auth');
Route::post('/dashboard/selfie-upload', [\App\Http\Controllers\DashboardController::class, 'uploadSelfie'])->name('dashboard.selfie.upload')->middleware('auth');
Route::post('/dashboard/photo-main/{id}', [\App\Http\Controllers\DashboardController::class, 'setMainPhoto'])->name('dashboard.photo.main')->middleware('auth');
Route::post('/dashboard/photo-delete/{id}', [\App\Http\Controllers\DashboardController::class, 'deletePhoto'])->name('dashboard.photo.delete')->middleware('auth');

// Interest System Routes
Route::middleware('auth')->group(function () {
    Route::post('/interest/send/{id}', [InterestController::class, 'sendInterest'])->name('interest.send');
    Route::post('/interest/cancel/{id}', [InterestController::class, 'cancelInterest'])->name('interest.cancel');
    Route::post('/interest/accept/{id}', [InterestController::class, 'acceptInterest'])->name('interest.accept');
    Route::post('/interest/reject/{id}', [InterestController::class, 'rejectInterest'])->name('interest.reject');

    // Chat System Routes
    Route::middleware('subscribed:chat')->group(function () {
        Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
        Route::get('/chat/{conversationId}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');
        Route::get('/chat/start/{userId}', [\App\Http\Controllers\ChatController::class, 'startConversation'])->name('chat.start');
        Route::get('/chat/messages/{conversationId}', [\App\Http\Controllers\ChatController::class, 'getMessages'])->name('chat.messages');
    });
    Route::post('/profile/unlock-contact/{id}', [\App\Http\Controllers\DashboardController::class, 'unlockContact'])->name('profile.unlock');
});

Route::get('/matches', [MatchController::class, 'index'])->name('matches')->middleware('auth');

// Horoscope Matching Routes (Public Service)
Route::get('/services/horoscope', [\App\Http\Controllers\DashboardController::class, 'horoscope'])->name('services.horoscope')->middleware('auth');
Route::get('/services/horoscope/check', [\App\Http\Controllers\DashboardController::class, 'checkHoroscopeMatch'])->name('horoscope.check');
Route::post('/services/horoscope/consultation', [\App\Http\Controllers\DashboardController::class, 'bookConsultation'])->name('consultation.book');
Route::post('/services/horoscope/upload', [\App\Http\Controllers\DashboardController::class, 'uploadHoroscope'])->name('services.horoscope.upload')->middleware('auth');
Route::delete('/services/horoscope/delete/{id}', [\App\Http\Controllers\DashboardController::class, 'deleteHoroscope'])->name('services.horoscope.delete')->middleware('auth');
Route::get('/services/horoscope/get-stars/{id}', [\App\Http\Controllers\DashboardController::class, 'getStars'])->name('services.horoscope.getStars');

Route::post('/services/book', [\App\Http\Controllers\ServiceBookingController::class, 'store'])->name('service.book');

Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events');

Route::get('/profile/{varan_id?}', [\App\Http\Controllers\DashboardController::class, 'viewProfile'])->name('profile.view');
Route::get('/members', function () {
    return view('pages.members');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/plans', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('plans.index');
Route::post('/payment/create-order', [\App\Http\Controllers\PaymentController::class, 'createOrder'])->name('payment.create');
Route::post('/payment/verify', [\App\Http\Controllers\PaymentController::class, 'verifyPayment'])->name('payment.verify');

Route::get('/register', function () {
    return view('pages.register');
})->middleware('guest');
Route::post('/send-otp', [\App\Http\Controllers\ProfileController::class, 'sendOTP']);
Route::post('/verify-otp', [\App\Http\Controllers\ProfileController::class, 'verifyOTP']);
Route::post('/register', [\App\Http\Controllers\ProfileController::class, 'store']);

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// Forgot Password Flow
Route::post('/forgot-password', [\App\Http\Controllers\LoginController::class, 'forgotPassword']);
Route::post('/verify-reset-otp', [\App\Http\Controllers\LoginController::class, 'verifyResetOTP']);
Route::post('/reset-password', [\App\Http\Controllers\LoginController::class, 'resetPassword']);

Route::get('/search', function () {
    return view('pages.members'); // Placeholder, using members page for search results
});

Route::get('/stories', function () {
    return redirect('/home#success-stories');
});

// Master Data API Routes
// Master Data API Routes
Route::group(['prefix' => 'api/master'], function () {
    Route::get('/religions', [\App\Http\Controllers\MasterDataController::class, 'getReligions']);
    Route::get('/castes', [\App\Http\Controllers\MasterDataController::class, 'getCastes']);
    Route::get('/subcastes', [\App\Http\Controllers\MasterDataController::class, 'getSubCastes']);
    Route::get('/marital-statuses', [\App\Http\Controllers\MasterDataController::class, 'getMaritalStatuses']);
    Route::get('/education', [\App\Http\Controllers\MasterDataController::class, 'getEduDetails']);
    Route::get('/income', [\App\Http\Controllers\MasterDataController::class, 'getIncome']);
    Route::get('/body-types', [\App\Http\Controllers\MasterDataController::class, 'getBodyTypes']);
    Route::get('/complexions', [\App\Http\Controllers\MasterDataController::class, 'getComplexions']);
    Route::get('/heights', [\App\Http\Controllers\MasterDataController::class, 'getHeights']);
    Route::get('/rasis', [\App\Http\Controllers\MasterDataController::class, 'getRasis']);
    Route::get('/stars', [\App\Http\Controllers\MasterDataController::class, 'getStars']);
    Route::get('/job-categories', [\App\Http\Controllers\MasterDataController::class, 'getJobCategories']);
});