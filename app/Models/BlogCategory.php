<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = static::uniqueSlug(Str::slug($category->name));
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug) && $category->name) {
                $category->slug = static::uniqueSlug(Str::slug($category->name), $category->id);
            }
        });
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_category_post');
    }

    public function getUrl(): string
    {
        return route('blog.category', $this->slug);
    }

    public static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base ?: 'category';
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
}
