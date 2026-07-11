<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->moveUpload($request->file('image'), 'testimonials');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->moveUpload($request->file('image'), 'testimonials', $testimonial->image);
        }

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteUpload($testimonial->image);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }

    private function moveUpload($file, string $folder, ?string $oldPath = null): string
    {
        $destination = public_path('uploads/' . $folder);
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

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

    private function deleteUpload(?string $path): void
    {
        if (!$path) {
            return;
        }

        $relative = Str::startsWith($path, 'uploads/') ? $path : 'uploads/' . ltrim($path, '/');

        $publicPath = public_path($relative);
        if (file_exists($publicPath)) {
            @unlink($publicPath);
            return;
        }

        $storagePath = storage_path('app/public/' . ltrim($path, '/'));
        if (file_exists($storagePath)) {
            @unlink($storagePath);
        }
    }
}
