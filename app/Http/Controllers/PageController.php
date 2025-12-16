<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        try {
            $page = Page::where('slug', $slug)
                ->where('status', 'published')
                ->with(['sections' => function ($query) {
                    $query->where('status', true)->orderBy('sort_order');
                }])
                ->firstOrFail();

            return view('frontend.page', compact('page'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Page not found: ' . $slug);
        } catch (\Exception $e) {
            abort(500, 'Error: ' . $e->getMessage());
        }
    }
}
