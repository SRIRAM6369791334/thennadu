<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = \App\Models\Contact::create($validated);

        // Send email to admin
        try {
            \Illuminate\Support\Facades\Mail::to('admin@thennadumatrimony.com')->send(new \App\Mail\AdminContactMail($contact));
        } catch (\Exception $e) {
            // Log the error but continue
            \Illuminate\Support\Facades\Log::error('Contact Email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully. We will contact you soon!');
    }
}
