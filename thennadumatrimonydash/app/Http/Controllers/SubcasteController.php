<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subcaste;
use App\Models\Caste;
use Illuminate\Support\Facades\DB;

class SubcasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caste = Caste::all();
        // $subcaste = Subcaste::all();
        $subcaste = DB::table('subcastes')
        ->join('castes','castes.id','=','subcastes.Category_name')
        ->select('subcastes.*','castes.Caste_name')
        ->get();
        return view('pages.subcaste',compact('caste','subcaste'));
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
        $subcaste = new Subcaste;
        $subcaste->Category_name = $request->input('Caste_name');
        $subcaste->subcategory_name = $request->input('subcaste_name');

        $subcaste->save();

        return redirect('/subcaste')->with('success','Sub Caste Added Successfully');
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
        $subcaste = Subcaste::find($id);
        $caste = Caste::all();
        return view('pages.subcasteEdit',compact('subcaste','caste'));
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
        $subcaste = Subcaste::find($id);

        $subcaste -> Category_name = $request->input('Caste_name');
        $subcaste -> SubCategory_name = $request->input('subcaste_name');

        $subcaste->update();

        return redirect('/subcaste')->with('success','SubCaste Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcaste = Subcaste::find($id);
        $subcaste -> delete();
        return redirect('/subcaste')->with('success','SubCaste Deleted Successfully');
    }
}


