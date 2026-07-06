<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Caste;
use App\Models\Subcaste;
use Illuminate\Support\Facades\DB;

class CasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $caste = Caste::all();
        $caste = DB::table('castes')
        ->join('regli_tb','regli_tb.id','=','castes.religion')
        ->select('castes.*','regli_tb.religion_name')
        ->get();
        
        $religion = DB::table('regli_tb')
->select('*')
->get();
        $subcaste = new Subcaste;
        return view('pages.caste',compact('caste','subcaste','religion'));
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
        $caste = new Caste;
        $caste->religion = $request->input('religion');
        $caste->Caste_name = $request->input('Caste_name');

        $caste->save();

        return redirect('/caste')->with('success','Caste Added Successfully');
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
        $caste = Caste::find($id);
        $religion = DB::table('regli_tb')->get();
        return view('pages.casteEdit',compact('caste','religion'));
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
        $caste = Caste::find($id);

        $caste->religion = $request->input('religion');
        $caste->Caste_name = $request->input('Caste_name');

        $caste->update();

        return redirect('/caste')->with('success','Caste Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caste = Caste::find($id);
        $caste -> delete();
        return redirect('/caste')->with('success','Caste Deleted Successfully');
    }
}


