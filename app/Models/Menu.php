<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'location',
        'link_type',
        'page_id',
        'url',
        'parent_id',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    public function getUrl()
    {
        if ($this->link_type === 'page' && $this->page) {
            return '/' . $this->page->slug;
        }
        return $this->attributes['url'] ?? '#';
    }

    public static function getByLocation(string $location)
    {
        return static::where('location', $location)
            ->where('status', true)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->with(['children' => function($query) {
                $query->where('status', true)->orderBy('sort_order')->with('parent');
            }])
            ->get();
    }
}
