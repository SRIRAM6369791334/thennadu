<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::all();
        $banner = DB::table('banner_img')
        ->select('*')
        ->first();
        return view('pages.offer',compact('offers','banner'));
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
        $offer = new Offer();
        $offer->offer_name = $request->input('offer_name');
        $offer->from_date = $request->input('fromdate');
        $offer->to_date = $request->input('todate');
        $offer->noofmblno = $request->input('noofmbl');
        // $offer->no_of_videos = $request->input('noofvideos') == 1 ? 1 : 0;
        $offer->no_of_images = $request->input('noofimages');
        $offer->validity = $request->input('validity');
        $offer->no_of_videos = $request->input('specification_1') == 1 ? 1 : 0;
        $offer->specification_3 = $request->input('specification_3') == 'yes' ? 'yes' : 'no';
        $offer->specification_4 = $request->input('specification_6') == 'yes' ? 'yes' : 'no';
        $offer->specification_5 = $request->input('specification_5') == 'yes' ? 'yes' : 'no';

        $offer->save();

        return redirect('/offer')->with('success','Offer Added Successfully');
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
    
    public function bannupdate(Request $request)
    {
        $banupd = DB::table('banner_img')->where('id',$request->id)->first();
        if($request->hasFile('bannimg'))
        {
            $destination = 'assets/banner/' .$banupd->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $file = $request->file('bannimg');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file -> move('assets/banner/',$filename);
            $banupd->image = $filename;
        }
        DB::table('banner_img')->where('id',$request->id)->update([
            'image' => $filename
            ]);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offer::find($id);
        return view('pages.offeredit',compact('offer'));
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
        $offer = Offer::find($id);

        $offer->offer_name = $request->input('offer_name');
        $offer->from_date = $request->input('fromdate');
        $offer->to_date = $request->input('todate');
        $offer->noofmblno = $request->input('noofmbl');
        $offer->no_of_videos = $request->input('specification_1') == 1 ? 1 : 0;
        $offer->no_of_images = $request->input('noofimages');
        $offer->validity = $request->input('validity');
        $offer->specification_3 = $request->input('specification_3') == 'yes' ? 'yes' : 'no';
        $offer->specification_4 = $request->input('specification_6') == 'yes' ? 'yes' : 'no';
        $offer->specification_5 = $request->input('specification_5') == 'yes' ? 'yes' : 'no';

        $offer->update();

        return redirect('/offer')->with('success','Offer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer -> delete();
        return redirect('/offer')->with('success','Offer Deleted Successfully');
    }
    
    public function offerbanenable($id){
        
        $banner = DB::table('banner_img')
        ->where('id',1)
        ->update([
            'status' => $id
        ]);
        
        return redirect('/offer');
    }
}


