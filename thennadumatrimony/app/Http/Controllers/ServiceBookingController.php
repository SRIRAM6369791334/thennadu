<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceBookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'date' => 'nullable|date',
            'time' => 'nullable',
            'message' => 'nullable|string',
        ]);

        $booking = new ServiceBooking($request->all());
        $booking->user_id = Auth::id(); // If logged in
        $booking->save();

        return back()->with('success', 'Thank you! Your consultation request has been received. Our team will contact you soon.');
    }
}
