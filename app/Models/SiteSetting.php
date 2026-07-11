<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'favicon',
        'header_phone',
        'site_address',
        'seo_google_verification',
        'seo_gtm_id',
        'seo_gtag_id',
        'seo_default_meta_description',
        'seo_default_meta_keywords',
        'seo_og_image',
        'seo_schema_json',
        'header_email',
        'whatsapp_number',
        'header_cta_text',
        'header_cta_link',
        'footer_text',
        'social_links',
        'color_pro_clean_blue',
        'color_pro_clean_red',
        'color_primary_1',
        'color_primary_2',
        'color_primary_3',
        'color_gray_1',
        'color_gray_2',
        'color_gray_3',
        'color_gray_4',
        'color_white',
        'color_success',
        'color_warning',
        'color_danger',
        'color_lime_green',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public static function getSettings()
    {
        return static::first() ?? new static();
    }
}
