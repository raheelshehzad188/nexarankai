<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function show(BlogPost $blogPost): View
    {
        if (! $blogPost->status || ($blogPost->published_at && $blogPost->published_at->isFuture())) {
            abort(404);
        }

        $blogPost->load('categories');

        $recentPosts = BlogPost::published()
            ->where('id', '!=', $blogPost->id)
            ->with('categories')
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $blogPost->id)
            ->whereHas('categories', fn ($q) => $q->whereIn('blog_categories.id', $blogPost->categories->pluck('id')))
            ->with('categories')
            ->orderByDesc('published_at')
            ->limit(2)
            ->get();

        if ($relatedPosts->count() < 2) {
            $relatedPosts = BlogPost::published()
                ->where('id', '!=', $blogPost->id)
                ->with('categories')
                ->orderByDesc('published_at')
                ->limit(2)
                ->get();
        }

        $bodyClass = 'irhas3 single-post-3';

        return view('frontend.blog.show', compact('blogPost', 'recentPosts', 'relatedPosts', 'bodyClass'));
    }

    public function category(BlogCategory $blogCategory): View
    {
        if (! $blogCategory->status) {
            abort(404);
        }

        $posts = BlogPost::published()
            ->whereHas('categories', fn ($q) => $q->where('blog_categories.id', $blogCategory->id))
            ->with('categories')
            ->orderByDesc('published_at')
            ->get();

        $bodyClass = 'irhas3 blog';

        return view('frontend.blog.category', compact('blogCategory', 'posts', 'bodyClass'));
    }
}
