<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class trackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tracking = DB::table('trackings')
        ->leftJoin('registers', 'trackings.user_varan_id', '=', 'registers.varan_id')
        ->select('trackings.*', 'registers.Name as user_name')
        ->groupBy('trackings.user_varan_id')
        ->get();

        return view('pages.tracking',compact('tracking'));
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
        $tracking = Tracking::find($id);
        $varanid  = $tracking->user_varan_id;

        $trackingview = DB::table('trackings')
            ->select('*')
            ->where('user_varan_id', '=', $varanid)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch main user name + profile id
        $userReg       = DB::table('registers')->where('varan_id', $varanid)->select('id', 'Name')->first();
        $userName      = $userReg ? $userReg->Name : $varanid;
        $userProfileId = $userReg ? $userReg->id   : null;

        // Collect all unique partner IDs → fetch names + numeric ids in one query
        $partnerIds  = $trackingview->pluck('partner_varan_id')->filter()->unique()->values();
        $partnerRegs = DB::table('registers')
            ->whereIn('varan_id', $partnerIds)
            ->select('id', 'varan_id', 'Name')
            ->get()
            ->keyBy('varan_id');
        $partnerNames      = $partnerRegs->map(fn($r) => $r->Name);
        $partnerProfileIds = $partnerRegs->map(fn($r) => $r->id);

        $requestsent    = DB::table('privacyphotolist')->where('photoid', $varanid)->count();
        $sentinterest   = DB::table('interests')->where([['user_varan_id', $varanid], ['Status', 'Intrested']])->count();
        $profileviewer  = DB::table('trackings')->where('partner_varan_id', $varanid)->whereIn('purpose', ['Profile_Viewed', 'Profile View'])->count();
        $profileviewed  = DB::table('trackings')->where('user_varan_id', $varanid)->whereIn('purpose', ['Profile_Viewed', 'Profile View'])->count();
        $sentinterestacc = DB::table('interests')->where([['user_varan_id', $varanid], ['partner_status', '1']])->count();
        $sentinterestrej = DB::table('interests')->where([['user_varan_id', $varanid], ['partner_status', '2']])->count();

        return view('pages.trackingview', compact(
            'trackingview',
            'varanid',
            'userName',
            'userProfileId',
            'partnerNames',
            'partnerProfileIds',
            'requestsent',
            'sentinterest',
            'profileviewer',
            'profileviewed',
            'sentinterestacc',
            'sentinterestrej'
        ));
    }
    
    public function trackingfromprofile($varanid){
        $trackingview = DB::table('trackings')
            ->select('*')
            ->where('user_varan_id','=',$varanid)
            ->orderBy('created_at','desc')
            ->get();

        // Fetch main user name + profile id
        $userReg = DB::table('registers')
            ->where('varan_id', $varanid)
            ->select('id', 'Name')
            ->first();
        $userName      = $userReg ? $userReg->Name : $varanid;
        $userProfileId = $userReg ? $userReg->id   : null;

        // Collect all unique partner IDs → fetch names + numeric ids in one query
        $partnerIds = $trackingview->pluck('partner_varan_id')->filter()->unique()->values();
        $partnerRegs = DB::table('registers')
            ->whereIn('varan_id', $partnerIds)
            ->select('id', 'varan_id', 'Name')
            ->get()
            ->keyBy('varan_id');
        $partnerNames      = $partnerRegs->map(fn($r) => $r->Name);
        $partnerProfileIds = $partnerRegs->map(fn($r) => $r->id);
        
        $requestsent = DB::table('privacyphotolist')
        ->where('photoid',$varanid)
        ->count();
        
        $sentinterest = DB::table('interests')
        ->where([['user_varan_id',$varanid],['Status','Intrested']])
        ->count();
        
        $profileviewer = DB::table('trackings')
        ->where('partner_varan_id',$varanid)
        ->whereIn('purpose',['Profile_Viewed','Profile View'])
        ->count();
        
        $profileviewed = DB::table('trackings')
        ->where('user_varan_id',$varanid)
        ->whereIn('purpose',['Profile_Viewed','Profile View'])
        ->count();
        
        $sentinterestacc = DB::table('interests')
        ->where([['user_varan_id',$varanid],['partner_status','1']])
        ->count();
        
        $sentinterestrej = DB::table('interests')
        ->where([['user_varan_id',$varanid],['partner_status','2']])
        ->count();

        return view('pages.trackingview',compact(
            'trackingview',
            'varanid',
            'userName',
            'userProfileId',
            'partnerNames',
            'partnerProfileIds',
            'requestsent',
            'sentinterest',
            'profileviewer',
            'profileviewed',
            'sentinterestacc',
            'sentinterestrej'
        ));
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
}


