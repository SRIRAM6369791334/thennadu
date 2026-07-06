<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::latest()->get();
        return view('pages.astro_bookings', compact('consultations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->status = $request->status;
        $consultation->save();

        return back()->with('success', 'Consultation status updated successfully.');
    }

    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return back()->with('success', 'Consultation record deleted successfully.');
    }
}
