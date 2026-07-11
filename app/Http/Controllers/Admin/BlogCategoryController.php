<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('posts')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCategory($request);

        if (empty($validated['slug'])) {
            $validated['slug'] = BlogCategory::uniqueSlug(Str::slug($validated['name']));
        }

        $validated['status'] = $request->boolean('status');

        BlogCategory::create($validated);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category created successfully!');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $this->validateCategory($request, $blogCategory->id);

        if (empty($validated['slug'])) {
            $validated['slug'] = BlogCategory::uniqueSlug(Str::slug($validated['name']), $blogCategory->id);
        }

        $validated['status'] = $request->boolean('status');

        $blogCategory->update($validated);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category updated successfully!');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->posts()->detach();
        $blogCategory->delete();

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category deleted successfully!');
    }

    private function validateCategory(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'nullable', 'string', 'max:255',
                Rule::unique('blog_categories', 'slug')->ignore($ignoreId),
            ],
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
    }
}
