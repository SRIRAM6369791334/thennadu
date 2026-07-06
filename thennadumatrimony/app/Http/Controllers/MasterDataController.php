<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    public function getReligions() {
        return response()->json(DB::table('regli_tb')->select('id', 'religion_name as name')->get());
    }

    public function getCastes(Request $request) {
        $query = DB::table('castes')->select('id', 'Caste_name as name');
        if($request->religion_id) {
            $query->where('religion', $request->religion_id);
        }
        return response()->json($query->get());
    }

    public function getSubCastes(Request $request) {
        $query = DB::table('subcastes')->select('id', 'subcategory_name as name');
        if($request->caste_id) {
            $query->where('Category_name', $request->caste_id);
        }
        return response()->json($query->get());
    }

    public function getMaritalStatuses() {
        return response()->json(DB::table('matrial_tb')->select('id', 'matrial_name as name')->get());
    }

    public function getEduDetails() {
        return response()->json(DB::table('eductiondetails_tb')->select('id', 'name')->get());
    }

    public function getIncome() {
        return response()->json(DB::table('income_tb')->select('id', 'salary as name')->get());
    }

    public function getBodyTypes() {
        return response()->json(DB::table('btype_tb')->select('id', 'btype as name')->get());
    }

    public function getComplexions() {
        return response()->json(DB::table('complexion_tb')->select('id', 'com_name as name')->get());
    }

    public function getHeights() {
        return response()->json(DB::table('height_tb')->select('id', 'height_name as name')->get());
    }

    public function getRasis() {
        return response()->json(DB::table('rasi_tb')->select('id', 'name')->get());
    }

    public function getStars() {
        return response()->json(DB::table('star')->select('id', 'name')->get());
    }

    public function getJobCategories() {
        return response()->json(DB::table('jobdescription_tb')->select('id', 'name')->get());
    }
}
