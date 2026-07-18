<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'schema_markup',
        'schema_type',
        'schema_service_type',
        'schema_area_locality',
        'schema_area_country',
        'status',
        'use_new_layout',
        'use_irhas_layout',
        'use_irhas2_layout',
    ];

    protected $casts = [
        'use_new_layout' => 'boolean',
        'use_irhas_layout' => 'boolean',
        'use_irhas2_layout' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
