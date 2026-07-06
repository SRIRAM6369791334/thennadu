<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userlogs = DB::table('logdetails_tb')
            ->select(
                'logdetails_tb.user_id',
                'logdetails_tb.user_ip',
                DB::raw('MAX(logdetails_tb.created_at) as last_login'),
                DB::raw('COUNT(*) as login_count'),
                'registers.Name as user_name'
            )
            ->leftJoin('registers', 'registers.varan_id', '=', 'logdetails_tb.user_id')
            ->groupBy('logdetails_tb.user_id', 'logdetails_tb.user_ip', 'registers.Name')
            ->orderByDesc('last_login')
            ->get();

        return view('pages.user_logs', compact('userlogs'));
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
        $userlogview = DB::table('logdetails_tb')
        ->select('*')
        ->where('user_id','=',$id)
        ->get();
        // dd($userlogview);
        return view('pages.logsview',compact('userlogview'));
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


