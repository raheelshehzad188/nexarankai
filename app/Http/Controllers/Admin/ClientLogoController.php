<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'logo' => 'nullable|image|max:2048',
            'logo_url' => 'nullable|url|max:500',
            'logo_source' => 'required|in:upload,url',
            'website' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        // Validate that either logo file or logo_url is provided
        if ($validated['logo_source'] === 'upload' && !$request->hasFile('logo')) {
            return back()->withErrors(['logo' => 'Please upload a logo image or select URL option.'])->withInput();
        }
        if ($validated['logo_source'] === 'url' && empty($validated['logo_url'])) {
            return back()->withErrors(['logo_url' => 'Please provide a logo URL.'])->withInput();
        }

        if ($request->hasFile('logo') && $validated['logo_source'] === 'upload') {
            $validated['logo'] = $this->moveUpload($request->file('logo'), 'clients');
            $validated['logo_url'] = null;
        } elseif ($validated['logo_source'] === 'url') {
            $validated['logo'] = null;
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
            'logo_url' => 'nullable|url|max:500',
            'logo_source' => 'required|in:upload,url',
            'website' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $logoSource = $validated['logo_source'] ?? ($clientLogo->logo_source ?? 'upload');

        if ($logoSource === 'upload') {
        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->moveUpload($request->file('logo'), 'clients', $clientLogo->logo);
                $validated['logo_url'] = null;
            } else {
                // Keep existing logo if no new file uploaded
                $validated['logo'] = $clientLogo->logo;
                $validated['logo_url'] = null;
            }
        } elseif ($logoSource === 'url') {
            if (empty($validated['logo_url'])) {
                return back()->withErrors(['logo_url' => 'Please provide a logo URL.'])->withInput();
            }
            // Delete uploaded logo if switching to URL
            if ($clientLogo->logo && $clientLogo->logo_source === 'upload') {
                $this->deleteUpload($clientLogo->logo);
            }
            $validated['logo'] = null;
        }

        $validated['logo_source'] = $logoSource;
        $clientLogo->update($validated);
        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo updated successfully!');
    }

    public function destroy(ClientLogo $clientLogo)
    {
        $this->deleteUpload($clientLogo->logo);
        $clientLogo->delete();
        return redirect()->route('admin.client-logos.index')->with('success', 'Client logo deleted successfully!');
    }

    /**
     * Move an uploaded file into public/uploads/{folder} and return relative path.
     */
    private function moveUpload($file, string $folder, ?string $oldPath = null): string
    {
        $destination = public_path('uploads/' . $folder);
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        // Remove old file if provided
        if ($oldPath) {
            $this->deleteUpload($oldPath);
        }

        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($name);
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '-' . $safeName . '.' . $extension;

        $file->move($destination, $filename);

        return 'uploads/' . $folder . '/' . $filename;
    }

    /**
     * Delete an uploaded file from public/uploads if it exists.
     */
    private function deleteUpload(?string $path): void
    {
        if (!$path) {
            return;
        }

        // Normalize incoming old paths (may be stored without uploads prefix)
        $relative = Str::startsWith($path, 'uploads/') ? $path : 'uploads/' . ltrim($path, '/');

        $publicPath = public_path($relative);
        if (file_exists($publicPath)) {
            @unlink($publicPath);
            return;
        }

        // Fallback: old storage path
        $storagePath = storage_path('app/public/' . ltrim($path, '/'));
        if (file_exists($storagePath)) {
            @unlink($storagePath);
        }
    }
}
