<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectionTypes = SectionType::orderBy('sort_order')->orderBy('name')->get();
        return view('admin.section-types.index', compact('sectionTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.section-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:section_types,slug',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            try {
                $imageFile = $request->file('image');
                $imagePath = $this->moveUpload($imageFile, 'section-types');
                $validated['image'] = $imagePath;
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'The image failed to upload: ' . $e->getMessage()])->withInput();
            }
        }

        $validated['status'] = $request->has('status') && $request->input('status') == '1';

        SectionType::create($validated);
        return redirect()->route('admin.section-types.index')->with('success', 'Section type created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SectionType $sectionType)
    {
        return view('admin.section-types.show', compact('sectionType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionType $sectionType)
    {
        return view('admin.section-types.edit', compact('sectionType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SectionType $sectionType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:section_types,slug,' . $sectionType->id,
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            try {
                // Delete old image
                if ($sectionType->image) {
                    $this->deleteUpload($sectionType->image);
                }
                $imageFile = $request->file('image');
                $imagePath = $this->moveUpload($imageFile, 'section-types');
                $validated['image'] = $imagePath;
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'The image failed to upload: ' . $e->getMessage()])->withInput();
            }
        }

        $validated['status'] = $request->has('status') && $request->input('status') == '1';

        $sectionType->update($validated);
        return redirect()->route('admin.section-types.index')->with('success', 'Section type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SectionType $sectionType)
    {
        if ($sectionType->image) {
            $this->deleteUpload($sectionType->image);
        }
        $sectionType->delete();
        return redirect()->route('admin.section-types.index')->with('success', 'Section type deleted successfully!');
    }

    private function moveUpload($file, string $folder, ?string $oldPath = null): string
    {
        $destination = public_path('uploads/' . $folder);
        
        // Create directory if it doesn't exist
        if (!is_dir($destination)) {
            if (!mkdir($destination, 0755, true)) {
                throw new \Exception('Failed to create upload directory. Please check permissions.');
            }
        }

        // Check if directory is writable
        if (!is_writable($destination)) {
            throw new \Exception('Upload directory is not writable. Please check permissions.');
        }

        if ($oldPath) {
            $this->deleteUpload($oldPath);
        }

        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($name);
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '-' . $safeName . '.' . $extension;
        $fullPath = $destination . '/' . $filename;

        // Move file
        if (!$file->move($destination, $filename)) {
            throw new \Exception('Failed to move uploaded file.');
        }

        // Verify file was moved successfully
        if (!file_exists($fullPath)) {
            throw new \Exception('File upload verification failed.');
        }

        return 'uploads/' . $folder . '/' . $filename;
    }

    private function deleteUpload(?string $path): void
    {
        if (!$path) {
            return;
        }

        $relative = Str::startsWith($path, 'uploads/') ? $path : 'uploads/' . ltrim($path, '/');
        $publicPath = public_path($relative);
        
        if (file_exists($publicPath)) {
            @unlink($publicPath);
        }
    }
}
