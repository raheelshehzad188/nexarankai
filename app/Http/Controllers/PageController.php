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

            $bodyClass = $this->resolveBodyClass($page);

            return view('frontend.page', compact('page', 'bodyClass'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Page not found: ' . $slug);
        } catch (\Exception $e) {
            abort(500, 'Error: ' . $e->getMessage());
        }
    }

    private function resolveBodyClass(Page $page): ?string
    {
        if ($page->use_irhas2_layout) {
            return match ($page->slug) {
                'services' => 'irhas2 service',
                'blog' => 'irhas2 blog',
                'contact' => 'irhas2 contact',
                default => 'irhas2 home2',
            };
        }

        if ($page->use_irhas_layout) {
            return match ($page->slug) {
                'services' => 'irhas3 service',
                'blog' => 'irhas3 blog',
                'contact' => 'irhas3 contact3',
                default => 'irhas3 home3',
            };
        }

        return null;
    }
}
