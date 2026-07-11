<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('serviceCategory')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->moveUpload($request->file('image'), 'services');
        }
        if ($request->hasFile('content_image')) {
            $validated['content_image'] = $this->moveUpload($request->file('content_image'), 'services');
        }

        $validated['status'] = $request->boolean('status');
        $validated['accordions'] = $this->decodeJsonField($request->input('accordions_json'));
        $validated['sidebar_testimonials'] = $this->decodeJsonField($request->input('sidebar_testimonials_json'));

        if (empty($validated['slug']) && ! empty($validated['title'])) {
            $validated['slug'] = Service::uniqueSlug(Str::slug($validated['title']));
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request, $service->id);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->moveUpload($request->file('image'), 'services', $service->image);
        }
        if ($request->hasFile('content_image')) {
            $validated['content_image'] = $this->moveUpload($request->file('content_image'), 'services', $service->content_image);
        }

        $validated['status'] = $request->boolean('status');
        $validated['accordions'] = $this->decodeJsonField($request->input('accordions_json'));
        $validated['sidebar_testimonials'] = $this->decodeJsonField($request->input('sidebar_testimonials_json'));

        if (empty($validated['slug']) && ! empty($validated['title'])) {
            $validated['slug'] = Service::uniqueSlug(Str::slug($validated['title']), $service->id);
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        $this->deleteUpload($service->image);
        $this->deleteUpload($service->content_image);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
    }

    private function validateService(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable', 'string', 'max:255',
                Rule::unique('services', 'slug')->ignore($ignoreId),
            ],
            'service_category_id' => 'nullable|exists:service_categories,id',
            'description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'image_alt' => 'nullable|string|max:255',
            'content_image' => 'nullable|image|max:4096',
            'icon_url' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
            'features_section_title' => 'nullable|string|max:255',
            'brochure_doc_url' => 'nullable|string|max:500',
            'brochure_pdf_url' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:500',
            'status' => 'nullable|boolean',
            'accordions_json' => 'nullable|string',
            'sidebar_testimonials_json' => 'nullable|string',
        ]);
    }

    private function decodeJsonField(?string $json): array
    {
        if (! $json) {
            return [];
        }

        $decoded = json_decode($json, true);

        return is_array($decoded) ? $decoded : [];
    }

    private function moveUpload($file, string $folder, ?string $oldPath = null): string
    {
        $destination = public_path('uploads/' . $folder);
        if (! is_dir($destination)) {
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
        if (! $path) {
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
