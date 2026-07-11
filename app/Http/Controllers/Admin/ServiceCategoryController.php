<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::withCount('services')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.service-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCategory($request);

        if (empty($validated['slug'])) {
            $validated['slug'] = ServiceCategory::uniqueSlug(Str::slug($validated['name']));
        }

        $validated['status'] = $request->boolean('status');

        ServiceCategory::create($validated);

        return redirect()->route('admin.service-categories.index')->with('success', 'Service category created successfully!');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.service-categories.edit', compact('serviceCategory'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validated = $this->validateCategory($request, $serviceCategory->id);

        if (empty($validated['slug'])) {
            $validated['slug'] = ServiceCategory::uniqueSlug(Str::slug($validated['name']), $serviceCategory->id);
        }

        $validated['status'] = $request->boolean('status');

        $serviceCategory->update($validated);

        return redirect()->route('admin.service-categories.index')->with('success', 'Service category updated successfully!');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->services()->update(['service_category_id' => null]);
        $serviceCategory->delete();

        return redirect()->route('admin.service-categories.index')->with('success', 'Service category deleted successfully!');
    }

    private function validateCategory(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'nullable', 'string', 'max:255',
                Rule::unique('service_categories', 'slug')->ignore($ignoreId),
            ],
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
    }
}
