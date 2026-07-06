<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caste;
use App\Models\Subcaste;
use Hamcrest\Matchers;
use Illuminate\Support\Facades\DB;
use App\Models\register;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caste = Caste::all();
        $subcaste = Subcaste::all();
        $country = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $city = DB::table('cities')->get();
        $education = DB::table('eductiondetails_tb')->get();
        $job = DB::table('jobdescription_tb')->get();
        $mor_ton = DB::table('mor_ton')->get();
        $btype_tb = DB::table('btype_tb')->get();
        $complexion = DB::table('complexion_tb')->get();
        $phy_tb = DB::table('phy_tb')
            ->select('*')
            ->where('id', '!=', 0)
            ->get();
        $height = DB::table('height_tb')->get();
        $matrial_tb = DB::table('matrial_tb')->get();
        $regli_tb = DB::table('regli_tb')->get();
        $rasi_tb = DB::table('rasi_tb')->get();
        $star_db = DB::table('star')->get();
        $income_tb = DB::table('income_tb')->get();

        return view('pages.matches', compact('caste', 'subcaste', 'country', 'states', 'city', 'education', 'job', 'mor_ton', 'btype_tb', 'complexion', 'phy_tb', 'height', 'matrial_tb', 'regli_tb', 'rasi_tb', 'star_db', 'income_tb'));
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

    public function filterData(Request $request)
    {
        $query = DB::table('registers')
            ->select(
                'registers.id',
                'registers.varan_id',
                'registers.Name',
                'registers.age',
                'registers.dob',
                'registers.Gender',
                'jobdescription_tb.name as job_cat',
                'countries.country_name',
                'states.state_name',
                'cities.city_name',
                'images.image_name',
                'star.name as star_name',
                'rasi_tb.name as rasi_name',
                'castes.Caste_name'
            )
            ->leftJoin('jobdescription_tb', 'registers.job_category', '=', 'jobdescription_tb.id')
            ->leftJoin('countries', 'registers.country', '=', 'countries.country_id')
            ->leftJoin('states', 'registers.state', '=', 'states.state_id')
            ->leftJoin('cities', 'registers.district', '=', 'cities.city_id')
            ->leftJoin('star', 'registers.stars', '=', 'star.id')
            ->leftJoin('rasi_tb', 'registers.rasi', '=', 'rasi_tb.id')
            ->leftJoin('castes', 'registers.Caste', '=', 'castes.id')
            ->leftJoin('images', function ($join) {
                $join->on('registers.varan_id', '=', 'images.varanid')
                    ->where('images.image_status', '=', 'Main');
            });

        // Age Filter
        if ($request->has('partneragefrom') && $request->has('partnerageto')) {
            $query->whereBetween('age', [$request->partneragefrom, $request->partnerageto]);
        }

        // Height Filter
        if ($request->has('partnerhtfrom') && $request->has('partnergtto') && $request->partnerhtfrom != "" && $request->partnergtto != "") {
            $query->whereBetween('height', [$request->partnerhtfrom, $request->partnergtto]);
        }

        // Multi-select filters helper
        $filterHelper = function($query, $column, $values, $nameTable = null, $nameColumn = null) {
            $vals = array_filter((array) $values, function($v) {
                return $v !== "" && $v !== "0" && $v !== 0;
            });
            
            if (!empty($vals)) {
                if ($nameTable && $nameColumn) {
                    // Inclusion of both IDs and Names for inconsistent databases
                    $names = DB::table($nameTable)->whereIn('id', $vals)->pluck($nameColumn)->toArray();
                    $query->where(function($q) use ($column, $vals, $names) {
                        $q->whereIn($column, $vals)
                          ->orWhereIn($column, $names);
                    });
                } else {
                    $query->whereIn($column, $vals);
                }
            }
        };

        if ($request->has('gender')) {
            $filterHelper($query, 'registers.Gender', $request->gender);
        }

        if ($request->has('bodytype')) {
            $filterHelper($query, 'registers.body_type', $request->bodytype);
        }

        if ($request->has('complexion')) {
            $filterHelper($query, 'registers.complexion', $request->complexion);
        }

        if ($request->has('maritalstatus')) {
            $filterHelper($query, 'registers.marital_status', $request->maritalstatus);
        }

        if ($request->has('education')) {
            $filterHelper($query, 'registers.eduction', $request->education, 'eductiondetails_tb', 'name');
        }

        if ($request->has('jobcategory')) {
            $filterHelper($query, 'registers.job_category', $request->jobcategory, 'jobdescription_tb', 'name');
        }

        if ($request->has('religion')) {
            $filterHelper($query, 'registers.Religion', $request->religion, 'regli_tb', 'religion_name');
        }

        if ($request->has('caste')) {
            $filterHelper($query, 'registers.Caste', $request->caste, 'castes', 'Caste_name');
        }

        if ($request->has('subcaste')) {
            $filterHelper($query, 'registers.sub_caste', $request->subcaste, 'subcastes', 'subcategory_name');
        }

        if ($request->has('star')) {
            $filterHelper($query, 'registers.stars', $request->star, 'star', 'name');
        }

        if ($request->has('dhosam')) {
            $filterHelper($query, 'registers.dosam', $request->dhosam);
        }

        if ($request->has('country')) {
            $filterHelper($query, 'registers.country', $request->country, 'countries', 'country_name');
        }

        if ($request->has('state')) {
            $filterHelper($query, 'registers.state', $request->state, 'states', 'state_name');
        }

        if ($request->has('city')) {
            $filterHelper($query, 'registers.district', $request->city, 'cities', 'city_name');
        }

        if ($request->has('annalincone')) {
            $filterHelper($query, 'registers.annual_income', $request->annalincone, 'income_tb', 'salary');
        }

        $register = $query->get();

        return view('pages.result', compact('register'));
    }
}
