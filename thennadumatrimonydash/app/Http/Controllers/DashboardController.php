<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\register;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function totalProfiles()
    {
        if (Auth::user()->role == 1) {
            $totalcount = DB::table('registers')
                ->get();
        }
        else if (Auth::user()->role == 3) {
            $totalcount = DB::table('registers')
                ->where('brokerid', Auth::user()->broker_id)
                ->get();
        }
        else if (Auth::user()->role == 2) {
            $totalcount = 0;
        }

        $newprofilescount = DB::table('registers')
            ->where('status', '1')
            ->get();

        $brokercount = DB::table('users')
            ->where('role', '3')
            ->get();

        $horoscopeapproved = DB::table('horoscopes')
            ->where('approval_status', '1')
            ->get();

        $horoscopepending = DB::table('horoscopes')
            ->where('approval_status', '0')
            ->get();

        $approvedvideos = DB::table('videos')
            ->where('video_status', '1')
            ->get();

        $pendingprofilescount = DB::table('registers')
            ->where([['status', '0'], ['blockstatus', '0']])
            ->get();

        $blockedprofilescount = DB::table('registers')
            ->where('blockstatus', '1')
            ->get();

        $imageapprovalpendingcount = DB::table('images')
            ->where('approve_status', '0')
            ->get();

        $imageapprovalcount = DB::table('images')
            ->where('approve_status', '1')
            ->get();

        $packagecount = DB::table('packages')
            ->get();

        $vendorcount = DB::table('vendors')
            ->select('*')
            ->where('Vendor_Type', '!=', 'Broker')
            ->get();

        $bannerimg = DB::table('bannerimgs')
            ->select('*')
            ->limit('5')
            ->get();

        $package = DB::table('packages')
            ->select('*')
            ->limit('6')
            ->get();

        $reportcount = DB::table('reports')
            ->select('*')
            ->limit('6')
            ->get();

        $users = DB::table('users')
            ->select('*')
            ->limit('6')
            ->get();

        $profilesdetails = DB::table('registers')
            ->select('*')
            ->where('status', '0')
            ->limit('10')
            ->get();




        return view('pages.dashboard', compact('horoscopepending', 'horoscopeapproved', 'totalcount', 'newprofilescount', 'pendingprofilescount', 'blockedprofilescount', 'imageapprovalcount', 'imageapprovalpendingcount', 'packagecount', 'bannerimg', 'package', 'users', 'profilesdetails', 'brokercount', 'vendorcount', 'approvedvideos', 'reportcount'));
    }


}
