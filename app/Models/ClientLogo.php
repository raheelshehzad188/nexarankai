<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientLogo extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'logo_url',
        'logo_source',
        'logo_alt',
        'website',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public static function getActive()
    {
        return static::where('status', true)->orderBy('sort_order')->get();
    }
}
