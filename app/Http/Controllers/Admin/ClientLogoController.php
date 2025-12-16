<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;

class ClientLogoController extends Controller
{
    public function index()
    {
        $clients = ClientLogo::orderBy('sort_order')->get();
        return view('admin.client-logos.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.client-logos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:2048',
            'website' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        ClientLogo::create($validated);
        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo created successfully!');
    }

    public function edit(ClientLogo $clientLogo)
    {
        return view('admin.client-logos.edit', compact('clientLogo'));
    }

    public function update(Request $request, ClientLogo $clientLogo)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $clientLogo->update($validated);
        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo updated successfully!');
    }

    public function destroy(ClientLogo $clientLogo)
    {
        $clientLogo->delete();
        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo deleted successfully!');
    }
}
