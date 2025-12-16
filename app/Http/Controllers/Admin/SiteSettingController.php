<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_logo' => 'nullable|image|max:2048',
            'header_phone' => 'nullable|string|max:255',
            'header_email' => 'nullable|email|max:255',
            'header_cta_text' => 'nullable|string|max:255',
            'header_cta_link' => 'nullable|url|max:255',
            'footer_text' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        if ($request->hasFile('site_logo')) {
            $validated['site_logo'] = $request->file('site_logo')->store('site', 'public');
        }

        $settings = SiteSetting::first();
        if ($settings) {
            $settings->update($validated);
        } else {
            SiteSetting::create($validated);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully!');
    }
}
