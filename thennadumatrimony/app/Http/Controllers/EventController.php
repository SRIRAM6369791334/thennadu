<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;

class EventController extends Controller
{
    public function index()
    {
        $services = Service::where('status', true)->latest()->get();
        return view('pages.events', compact('services'));
    }
}
