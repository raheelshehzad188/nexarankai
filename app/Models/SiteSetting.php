<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_logo',
        'header_phone',
        'header_email',
        'header_cta_text',
        'header_cta_link',
        'footer_text',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public static function getSettings()
    {
        return static::first() ?? new static();
    }
}
