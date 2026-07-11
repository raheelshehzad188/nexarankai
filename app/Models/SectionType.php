<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset($this->image);
        }
        return null;
    }
}
