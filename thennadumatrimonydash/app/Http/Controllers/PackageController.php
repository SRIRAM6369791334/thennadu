<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Package;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package = Package::all();
        return view('pages.packages',compact('package'));
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
        $s1 ="0";
        $s3 ="no";
        $s4 ="0";
        $s5 ="no";
        $s6 = "no";
        if($request->input('specification_1') != null) {
         $s1=$request->input('specification_1');
        }
        if($request->input('specification_3') != null) {
         $s3=$request->input('specification_3');
        }
         if($request->input('specification_4') != null) {
         $s4=$request->input('specification_4');
        } 
        if($request->input('specification_5') != null) {
         $s5=$request->input('specification_5');
        }
        if($request->input('specification_6') != null) {
         $s6=$request->input('specification_6');
        }
        
        $package = new Package;
        $package->package_name = $request->input('package_name');
        $package->package_price = $request->input('package_price');
        $package->no_of_videos = $s1;
        $package->no_of_images = $request->input('specification_2');
        $package->specification_3 = $s3;
        $package->specification_4 = $s4;
        $package->specification_5 = $s5;
        $package->specification_6 = $s6;
        $package->specification_7 = $request->input('specification_7');
        $package->specification_8 = $request->input('specification_8');
        $package->specification_9 = $request->input('specification_9');
        $package->specification_10 = $request->input('specification_10');
        $package->validity = $request->input('validity');
        $package->noofmblno = $request->input('noofmbl');

        $package->save();

        return redirect('/packages')->with('success','Packages Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        return view('pages.packageEdit',compact('package'));
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
        $package = Package::find($id);
        
        $videos = $request->input('specification_1') == 1 ? 1 : 0;
        $chat = $request->input('specification_3') == 'yes' ? 'yes' : 'no';
        $advancesearch = $request->input('specification_5') == 'yes' ? 'yes' : 'no';
        $call = $request->input('specification_6') == 'yes' ? 'yes' : 'no';

        $package->package_name = $request->input('package_name');
        $package->package_price = $request->input('package_price');
        $package->no_of_videos = $videos;
        $package->no_of_images = $request->input('specification_2');
        $package->specification_3 = $chat;
        $package->specification_5 = $advancesearch;
        $package->specification_6 = $call;
        $package->validity = $request->validity;
        $package->noofmblno = $request->noofmbl;

        $package->update();

        return redirect('/packages')->with('success','Packages Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $package -> delete();
        return redirect('/packages')->with('success','Packages Deleted Successfully');
    }
    
    public function packstatuschange($packid = null, $id = null){
        
        $text = ($id == 1 ? 1 : 0) == 0 ? "Enabled" : "Disabled";
        
        DB::table('packages')->where('id',$packid)->update([
           'package_status' =>  $id
        ]);
        
        return redirect('/packages')->with('success','Packages '.$text.' Successfully');
    }
}


