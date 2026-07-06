<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class ServiceBookingController extends Controller
{
    public function index()
    {
        $bookings = ServiceBooking::with('service')->latest()->get();
        return view('pages.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = ServiceBooking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Booking status updated successfully.');
    }

    public function destroy($id)
    {
        $booking = ServiceBooking::findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Booking deleted successfully.');
    }
}
