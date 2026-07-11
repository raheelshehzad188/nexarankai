<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('page', 'parent')->orderBy('location')->orderBy('sort_order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $pages = Page::where('status', 'published')->get();
        $parents = Menu::whereNull('parent_id')->get();
        return view('admin.menus.create', compact('pages', 'parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|in:header,footer',
            'link_type' => 'required|in:page,custom',
            'page_id' => 'nullable|required_if:link_type,page|exists:pages,id',
            'url' => 'nullable|required_if:link_type,custom|url|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        Menu::create($validated);
        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully!');
    }

    public function edit(Menu $menu)
    {
        $pages = Page::where('status', 'published')->get();
        $parents = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
        return view('admin.menus.edit', compact('menu', 'pages', 'parents'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|in:header,footer',
            'link_type' => 'required|in:page,custom',
            'page_id' => 'nullable|required_if:link_type,page|exists:pages,id',
            'url' => 'nullable|required_if:link_type,custom|url|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $menu->update($validated);
        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully!');
    }
}
