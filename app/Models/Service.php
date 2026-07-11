<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'service_category_id',
        'description',
        'excerpt',
        'content',
        'image',
        'image_alt',
        'content_image',
        'icon_url',
        'published_at',
        'sort_order',
        'features_section_title',
        'accordions',
        'brochure_doc_url',
        'brochure_pdf_url',
        'sidebar_testimonials',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'published_at' => 'date',
        'accordions' => 'array',
        'sidebar_testimonials' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = static::uniqueSlug(Str::slug($service->title));
            }
        });

        static::updating(function ($service) {
            if (empty($service->slug) && $service->title) {
                $service->slug = static::uniqueSlug(Str::slug($service->title), $service->id);
            }
        });
    }

    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function getCategoryNameAttribute(): ?string
    {
        return $this->serviceCategory?->name;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base ?: 'service';
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
        return route('services.show', $this->slug);
    }

    public function imageUrl(?string $field = 'image'): ?string
    {
        $path = $this->{$field} ?? null;
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset(str_starts_with($path, 'uploads/') ? $path : 'uploads/' . ltrim($path, '/'));
    }

    public static function getActive()
    {
        return static::where('status', true)
            ->with('serviceCategory')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();
    }
}
