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

            $bodyClass = match ($page->slug) {
                'services' => 'irhas3 service',
                'blog' => 'irhas3 blog',
                'contact' => 'irhas3 contact3',
                default => null,
            };

            return view('frontend.page', compact('page', 'bodyClass'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Page not found: ' . $slug);
        } catch (\Exception $e) {
            abort(500, 'Error: ' . $e->getMessage());
        }
    }
}
