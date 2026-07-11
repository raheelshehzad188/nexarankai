<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('categories')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.blog-posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePost($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->moveUpload($request->file('featured_image'), 'blog');
        }
        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $this->moveUpload($request->file('author_image'), 'blog');
        }

        $validated['status'] = $request->boolean('status');
        $validated['tags'] = $this->parseTags($request->input('tags'));

        if (empty($validated['slug'])) {
            $validated['slug'] = BlogPost::uniqueSlug(Str::slug($validated['title']));
        }

        $categoryIds = $request->input('category_ids', []);

        $post = BlogPost::create($validated);
        $post->categories()->sync($categoryIds);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully!');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::orderBy('sort_order')->orderBy('name')->get();
        $blogPost->load('categories');

        return view('admin.blog-posts.edit', compact('blogPost', 'categories'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $this->validatePost($request, $blogPost->id);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->moveUpload($request->file('featured_image'), 'blog', $blogPost->featured_image);
        }
        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $this->moveUpload($request->file('author_image'), 'blog', $blogPost->author_image);
        }

        $validated['status'] = $request->boolean('status');
        $validated['tags'] = $this->parseTags($request->input('tags'));

        if (empty($validated['slug'])) {
            $validated['slug'] = BlogPost::uniqueSlug(Str::slug($validated['title']), $blogPost->id);
        }

        $blogPost->update($validated);
        $blogPost->categories()->sync($request->input('category_ids', []));

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $blogPost)
    {
        $this->deleteUpload($blogPost->featured_image);
        $this->deleteUpload($blogPost->author_image);
        $blogPost->categories()->detach();
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully!');
    }

    private function validatePost(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable', 'string', 'max:255',
                Rule::unique('blog_posts', 'slug')->ignore($ignoreId),
            ],
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:4096',
            'author_name' => 'nullable|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'author_image' => 'nullable|image|max:2048',
            'author_bio' => 'nullable|string',
            'tags' => 'nullable|string',
            'published_at' => 'nullable|date',
            'status' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:500',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:blog_categories,id',
        ]);
    }

    private function parseTags(?string $tags): array
    {
        if (! $tags) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $tags))));
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
        }
    }
}
