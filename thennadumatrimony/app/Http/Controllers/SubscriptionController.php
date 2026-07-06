<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        $packages = Package::where('package_status', 1)->get();
        $activePackageName = null;
        
        if (Auth::check()) {
            $user = Auth::user();
            $activePlan = UserPackage::where('user_varan_id', $user->varan_id)
                ->where('status', 1)
                ->where('payment_status', 'Paid')
                ->where('validity_date', '>=', Carbon::now())
                ->first();
            if ($activePlan) {
                $activePackageName = $activePlan->package_name;
            }
        }

        return view('pages.plans', compact('packages', 'activePackageName'));
    }

    public function subscribe(Request $request, $id)
    {
        $user = Auth::user();
        $package = Package::findOrFail($id);

        // Cancel previous active packages
        UserPackage::where('user_varan_id', $user->varan_id)
            ->where('status', 1)
            ->update(['status' => 0]);

        // Calculate limits from package
        $videos = $package->no_of_videos ? 1 : 0;
        $images = (int) $package->no_of_images;
        
        // specification_3 is chat (yes/no)
        $enableChat = strtolower($package->specification_3) === 'yes' ? 'yes' : 'no';
        // specification_5 is advanced search (yes/no)
        $enableAdvancedSearch = strtolower($package->specification_5) === 'yes' ? 'yes' : 'no';
        // specification_6 is call (yes/no)
        $enableCall = strtolower($package->specification_6) === 'yes' ? 'yes' : 'no';

        UserPackage::create([
            'user_varan_id' => $user->varan_id,
            'package_name' => $package->package_name,
            'package_price' => $package->package_price,
            'no_of_video' => $videos,
            'no_of_video_upload' => 0,
            'no_of_image' => $images,
            'no_of_image_upload' => 0,
            'no_of_horo' => 1,
            'no_of_horo_upload' => 0,
            'no_of_phno' => $package->noofmblno ?? 0,
            'no_of_phno_viewed' => 0,
            'enable_chat' => $enableChat,
            'enable_call' => $enableCall,
            'enable_horoschope' => 'yes',
            'enable_advancesearch' => $enableAdvancedSearch,
            'validity_date' => Carbon::now()->addDays($package->validity),
            'payment_status' => 'Pending',
            'payment_id' => 'PAY_PENDING_' . strtoupper(uniqid()),
            'status' => 0
        ]);

        return redirect()->route('dashboard')->with('success', 'Your request for ' . $package->package_name . ' has been submitted! Please contact Admin to complete the payment and activate your plan.');
    }
}
