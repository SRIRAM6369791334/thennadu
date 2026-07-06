<?php

namespace App\Http\Controllers;

use App\Models\Menupermission;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


class MenuPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menupermission = Menupermission::all();
        $users = User::all();

        return view('pages.users', compact('menupermission', 'users'));
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
    public function update(Request $request, $name)
    {
        $userid = $request->userid;
        // $username=$name;
        $permission = $request->viewpermission;
        $userNewId = $request->userId;



        DB::table("menupermissions")->where("id", $userid)->update([
            $userNewId => $permission
        ]);




        // $sql = "UPDATE menu SET ".$uid."= $sta where id=$tempid ";
        // $updatedata = DB::statement("UPDATE menupermissions SET " . $name . "= $permission where id=$userid");




        return redirect()->back()->with('message', 'Operation Successful !');
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

    public function datacheck($name, $id = null)
    {






        // $sql = "SELECT id,menu,mainmenu,menu_type,? as username , '$id' FROM menupermissions WHERE `$id` = '$id'  ORDER BY id ASC";
        // $data = DB::select($sql, [$name]);
        $data =  DB::table("menupermissions")->select(["id", "menu", "mainmenu", "menu_type", "$id", "$id as username"])->orderBy("id", "asc")->get();
        $userId = $id;


        // $data = DB::select('SELECT id,menu,mainmenu,menu_type,' . $name . ' as username  FROM menupermissions order by id asc');
        // dd($data);
        // return view("pages.permission",['data'=>$data]);

        return View::make('pages.permission', ['users' => $data, "name" => $name, "userId" => $userId]);
    }
}


