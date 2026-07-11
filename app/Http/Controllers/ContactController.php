<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Notifications\NewLeadReceived;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'service_required' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $name = $validated['name'] ?? $validated['username'] ?? null;
        if (! $name) {
            return redirect()->back()->withErrors(['username' => 'Please enter your name.'])->withInput();
        }

        $combinedMessage = $validated['message'];
        if (! empty($validated['location'])) {
            $combinedMessage .= "\nLocation: " . $validated['location'];
        }
        $serviceRequired = $validated['service_required'] ?? $validated['service'] ?? null;
        if (! empty($serviceRequired)) {
            $combinedMessage .= "\nService Required: " . $serviceRequired;
        }

        $lead = Lead::create([
            'name' => $name,
            'email' => $validated['email'] ?? '',
            'phone' => $validated['phone'] ?? null,
            'message' => $combinedMessage,
            'page' => $request->header('referer'),
        ]);

        try {
            $adminUsers = User::all();
            foreach ($adminUsers as $admin) {
                $admin->notify(new NewLeadReceived($lead));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }

        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
