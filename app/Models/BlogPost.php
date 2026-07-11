<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author_name',
        'author_role',
        'author_image',
        'author_bio',
        'tags',
        'published_at',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
    ];

    protected $casts = [
        'status' => 'boolean',
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = static::uniqueSlug(Str::slug($post->title));
            }
        });

        static::updating(function ($post) {
            if (empty($post->slug) && $post->title) {
                $post->slug = static::uniqueSlug(Str::slug($post->title), $post->id);
            }
        });
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_post');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base ?: 'post';
        $original = $slug;
        $counter = 1;

        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }

    public function getUrl(): string
    {
        return route('blog.show', $this->slug);
    }

    public function imageUrl(?string $field = 'featured_image'): ?string
    {
        $path = $this->{$field} ?? null;
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return asset(str_starts_with($path, 'uploads/') ? $path : 'uploads/' . ltrim($path, '/'));
    }

    public function scopePublished($query)
    {
        return $query->where('status', true)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    public static function publishedList(int $limit = 0)
    {
        $query = static::published()
            ->with('categories')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');

        return $limit > 0 ? $query->limit($limit)->get() : $query->get();
    }

    public function getTagsListAttribute(): array
    {
        return is_array($this->tags) ? array_filter($this->tags) : [];
    }

    public function getCategoryNamesAttribute(): string
    {
        return $this->categories->pluck('name')->implode(', ');
    }
}
