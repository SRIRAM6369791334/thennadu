<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = DB::table('contacts')->orderBy('id', 'desc')->get();
        return view('pages.contacts', compact('contacts'));
    }

    public function destroy($id)
    {
        DB::table('contacts')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Contact enquiry deleted successfully');
    }
}
