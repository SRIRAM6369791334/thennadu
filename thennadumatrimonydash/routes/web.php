<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\BannerimgController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CasteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\MenuPermissionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SubcasteController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\trackingController;

use App\Http\Controllers\reportController;
use App\Http\Controllers\requestController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserlogController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\Admin\InterestManagementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceBookingController;
use App\Http\Controllers\ConsultationController;

Route::resource('success-stories', SuccessStoryController::class)->middleware('shareauth');
Route::resource('services', ServiceController::class)->middleware('shareauth');

// Service Bookings
Route::group(['middleware' => 'shareauth'], function () {
    Route::get('service-bookings', [ServiceBookingController::class , 'index'])->name('bookings.index');
    Route::post('service-bookings/status/{id}', [ServiceBookingController::class , 'updateStatus'])->name('bookings.status');
    Route::delete('service-bookings/{id}', [ServiceBookingController::class , 'destroy'])->name('bookings.destroy');
});

// Astro Consultations
Route::group(['middleware' => 'shareauth'], function () {
    Route::get('astro-bookings', [ConsultationController::class , 'index'])->name('astro.index');
    Route::post('astro-bookings/status/{id}', [ConsultationController::class , 'updateStatus'])->name('astro.status');
    Route::delete('astro-bookings/{id}', [ConsultationController::class , 'destroy'])->name('astro.destroy');

    Route::get('contact-enquiries', [App\Http\Controllers\ContactController::class , 'index'])->name('contacts.index');
    Route::delete('contact-enquiries/{id}', [App\Http\Controllers\ContactController::class , 'destroy'])->name('contacts.destroy');
});

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/', function () {
    return view('pages.login');
});


Route::view('signup', 'pages.signup')->middleware('guest');
Route::post('store', [AdminRegisterController::class , 'store']);
Route::view('dashboard', 'pages.dashboard')->middleware('shareauth');

Route::view('login', 'pages.login')->name('login')->middleware('guest');
Route::post('authenticate', [LoginController::class , 'authenticate']);

Route::get('logout', [LoginController::class , 'logout']);


// Route::view('packages','pages.packages');
// Route::post('storepackages',[PackageController::class,'store']);
Route::resource('packages', PackageController::class)->middleware('shareauth');
Route::resource('profile-images', ImageController::class)->middleware('shareauth');

Route::resource('caste', CasteController::class)->middleware('shareauth');
Route::resource('subcaste', SubcasteController::class)->middleware('shareauth');
Route::resource('banner', BannerimgController::class)->middleware('shareauth');
Route::resource('banners', BannerController::class)->middleware('shareauth');

// Route::post('packages',PackageController::class);

Route::resource('profiles', registerController::class)->middleware('shareauth');
Route::get('/get-cast/{id}', [registerController::class , 'getCast']);
Route::get('/get-subcast/{id}', [registerController::class , 'getSubCast']);
Route::get('/get-stars/{id}', [registerController::class , 'getStars']);
Route::get('/get-state/{id}', [registerController::class , 'getStates']);
Route::get('/get-city/{id}', [registerController::class , 'getCities']);

Route::post('statusChange', [registerController::class , 'statusChange'])->middleware('shareauth');
Route::post('brokerStatusChange', [registerController::class , 'brokerStatusChange'])->middleware('shareauth');
Route::post('imageStatuschange', [ImageController::class , 'imageStatuschange'])->middleware('shareauth');
Route::get('newprofiles', [registerController::class , 'newprofiles'])->middleware('shareauth');
Route::get('premiumprofiles', [registerController::class , 'premiumprofiles'])->middleware('shareauth');

Route::resource('matches', MatchesController::class)->middleware('shareauth');

Route::post('filterData', [MatchesController::class , 'filterData'])->middleware('shareauth');

Route::view('result', 'pages.result')->middleware('shareauth');

Route::resource('navbar', NotificationController::class)->middleware('shareauth');

Route::get('users', [AdminRegisterController::class , 'index'])->middleware('shareauth');
Route::get('datacheck/{name?}/{id?}', [MenuPermissionController::class , 'datacheck'])->middleware('shareauth');

Route::get('dashboard', [DashboardController::class , 'totalProfiles'])->middleware('shareauth');


Route::resource('permission', MenuPermissionController::class)->middleware('shareauth');

Route::resource('tracking', trackingController::class)->middleware('shareauth');

Route::get('brokers', [AdminRegisterController::class , 'getbrokers'])->middleware('shareauth');

Route::post('brokerPercentage', [AdminRegisterController::class , 'brokerPercentage'])->middleware('shareauth');

Route::resource('broker', BrokerController::class)->middleware('shareauth');

Route::post('sendpaymentreq', [BrokerController::class , 'sendpaymentreq'])->middleware('shareauth');

Route::post('paidstatuschange', [BrokerController::class , 'paidstatuschange'])->middleware('shareauth');

Route::get('brokersview', [registerController::class , 'brokerprofiles'])->middleware('shareauth');

Route::get('horoscopeimg', [HoroscopeController::class , 'index'])->middleware('shareauth');
Route::post('horoscopeStatuschange', [HoroscopeController::class , 'horoscopeStatuschange'])->middleware('shareauth');

Route::get('approveprofileimg', [ImageController::class , 'approveprofileimg'])->middleware('shareauth');
Route::get('pendingprofileimg', [ImageController::class , 'pendingprofileimg'])->middleware('shareauth');
Route::get('approveallprofileimg', [ImageController::class , 'approveallprofileimg'])->middleware('shareauth');

Route::get('pendinghoroscopeimg', [HoroscopeController::class , 'pendingprofileimg'])->middleware('shareauth');
Route::get('approvehoroscopeimg', [HoroscopeController::class , 'approveprofileimg'])->middleware('shareauth');
Route::get('approveallhoroscopeimg', [HoroscopeController::class , 'approveallhoroscopeimg'])->middleware('shareauth');

Route::resource('report', reportController::class)->middleware('shareauth');

Route::resource('youtubevideo', YoutubeController::class)->middleware('shareauth');

Route::resource('vendors', VendorController::class)->middleware('shareauth');

Route::resource('user-logs', UserlogController::class)->middleware('shareauth');

Route::post('reportstatusChange', [reportController::class , 'reportstatusChange'])->middleware('shareauth');

Route::resource('request', requestController::class)->middleware('shareauth');

Route::resource('testimonials', TestimonialController::class)->middleware('shareauth');

Route::resource('videos', VideoController::class)->middleware('shareauth');

Route::resource('offer', OfferController::class)->middleware('shareauth');

Route::post('vendorStatusChange', [VendorController::class , 'vendorStatusChange'])->middleware('shareauth');

Route::get('deleterecord', [registerController::class , 'getdeleterecords'])->middleware('shareauth');

Route::post('deletestatuschange', [registerController::class , 'deletestatuschange'])->middleware('shareauth');
Route::post('videoStatuschange', [VideoController::class , 'videoStatuschange'])->middleware('shareauth');
// Route::view('brokersview','pages.brokersview');

Route::get('trackingprofile/{varanid?}', [trackingController::class , 'trackingfromprofile'])->middleware('shareauth');

Route::get('profilefilter/{id?}', [registerController::class , 'profilefilter'])->middleware('shareauth');

Route::post('Blockstatus', [registerController::class , 'Blockstatus'])->middleware('shareauth');

Route::get('approvedvideofil', [VideoController::class , 'approvedvideofil'])->middleware('shareauth');

Route::get('/enadis/{packid?}/{status?}', [PackageController::class , 'packstatuschange'])->middleware('shareauth');

Route::post('/bannupd', [OfferController::class , 'bannupdate']);

// Chat System Routes
Route::middleware('shareauth')->group(function () {
    Route::get('/chat', [App\Http\Controllers\ChatController::class , 'index'])->name('chat.index');
    Route::get('/chat/{conversationId}', [App\Http\Controllers\ChatController::class , 'show'])->name('chat.show');
    Route::post('/chat/send', [App\Http\Controllers\ChatController::class , 'sendMessage'])->name('chat.send');
    Route::post('/chat/start/{userId}', [App\Http\Controllers\ChatController::class , 'startConversation'])->name('chat.start');
    Route::get('/chat/messages/{conversationId}', [App\Http\Controllers\ChatController::class , 'getMessages'])->name('chat.messages');
});

// Admin Interest Management Routes
Route::group(['prefix' => 'admin', 'middleware' => 'shareauth'], function () {
    Route::get('interests', [InterestManagementController::class , 'index']);
    Route::post('interests/accept/{id}', [InterestManagementController::class , 'accept']);
    Route::post('interests/reject/{id}', [InterestManagementController::class , 'reject']);
    Route::delete('interests/{id}', [InterestManagementController::class , 'destroy']);
    Route::get('interests/profile/{id}/{type?}', [InterestManagementController::class , 'showProfile']);

    // Admin Chat Management Routes
    Route::get('chat', [App\Http\Controllers\Admin\ChatManagementController::class , 'index'])->name('admin.chat.index');
    Route::get('chat/{id}', [App\Http\Controllers\Admin\ChatManagementController::class , 'show'])->name('admin.chat.show');
    Route::post('chat/delete/{id}', [App\Http\Controllers\Admin\ChatManagementController::class , 'destroy'])->name('admin.chat.delete');
    Route::post('chat/block/{userId}', [App\Http\Controllers\Admin\ChatManagementController::class , 'blockUser'])->name('admin.chat.block');
    Route::post('chat/flag/{messageId}', [App\Http\Controllers\Admin\ChatManagementController::class , 'flagMessage'])->name('admin.chat.flag');
});

Route::get('/offerbanenable/{id?}', [OfferController::class , 'offerbanenable']);
