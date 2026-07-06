<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminRegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate
        (
            [
                'name'=>'required',
                'email'=>'required',
                'mblnum'=>'required',
                'password'=>'required',
                'role'=>'required'
            ]
            );

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->mblno = $request->input('mblnum');
            $user->role = $request->input('role');
            $user->showpasswd = $request->input('password');

            if($user->role == 3)
            {
                $invID =0;
                $maxValue = DB::table('users')
                ->WHERE('role','3')
                ->count();
                $invID=$maxValue+1;
                $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);

                $MatId="TNBR".$invID;
            }
            else
            {
                $MatId = "";
            }

            $user->broker_id = $MatId;
            
            $invID1 =0;
            $maxValue1 = DB::table('users')
            ->max('id');
            $invID1 = $maxValue1 + 1;
            $invID1 = str_pad($invID1, 5, '0', STR_PAD_LEFT);

            $menucolname = "USERS".$invID1;
            
            $user->user_ID = $menucolname;
            
            $user->save();
            // $uname = $user->name;
            // Auth::login($user);
            
           


            DB::statement('ALTER TABLE menupermissions ADD '.$menucolname.' INT(1) NOT NULL DEFAULT 0');
            if($user->role == 3)
            {
                DB::statement('UPDATE menupermissions SET '.$menucolname.' = "0" WHERE menu_no IN(8,10,11)');

                DB::statement('UPDATE menupermissions SET '.$menucolname.' = "1" WHERE menu_no IN(1,2,3,4,5,6,7,9,12,13,14,15,16,17,18,19,20,21,22,23,24,25)');
            }
            return redirect('users');
    }

    public function index()
    {
        $users = DB::table('users')
        ->select('*')
        ->whereIn('role',[1, 2])
        ->get();

        return view('pages.users',compact('users'));
    }

    public function getbrokers()
    {
        $brokers = DB::table('users')
        ->select('*')
        ->where('role','=','3')
        ->get();
        
        return view('pages.broker',compact('brokers'));
    }

    public function brokerPercentage(Request $request)
    {
        $percentage = $request->percentage;
        $targetvalue = $request->targetvalue;
        $brokerid = $request->brokerid;

        $updatedata= DB::table('users')->where('broker_id',$brokerid)->update(array(
            'user_payment_percentage'=>$percentage,
            'target_value'=>$targetvalue
        ));

        if($updatedata)
        {
            return redirect('/brokers')->with('success',' Percentage Updated');
        }
    }
}


