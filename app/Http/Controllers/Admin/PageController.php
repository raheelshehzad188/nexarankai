<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'schema_markup' => 'nullable|string',
            'schema_type' => 'nullable|in:service,webpage',
            'schema_service_type' => 'nullable|string|max:100',
            'schema_area_locality' => 'nullable|string|max:100',
            'schema_area_country' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published',
            'layout' => 'required|in:default,irhas,irhas2,new',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $this->applyLayoutFlags($validated, $validated['layout']);
        unset($validated['layout']);

        Page::create($validated);
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'schema_markup' => 'nullable|string',
            'schema_type' => 'nullable|in:service,webpage',
            'schema_service_type' => 'nullable|string|max:100',
            'schema_area_locality' => 'nullable|string|max:100',
            'schema_area_country' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published',
            'layout' => 'required|in:default,irhas,irhas2,new',
        ]);

        $this->applyLayoutFlags($validated, $validated['layout']);
        unset($validated['layout']);

        $page->update($validated);
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully!');
    }

    /**
     * Map a single layout select value onto the boolean layout flags.
     */
    private function applyLayoutFlags(array &$validated, string $layout): void
    {
        $validated['use_irhas2_layout'] = $layout === 'irhas2';
        $validated['use_irhas_layout'] = $layout === 'irhas';
        $validated['use_new_layout'] = $layout === 'new';
    }
}
