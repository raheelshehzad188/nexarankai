<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'review',
        'rating',
        'image',
        'image_alt',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public static function getActive()
    {
        return static::where('status', true)->get();
    }
}
