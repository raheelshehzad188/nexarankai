<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('site_settings', 'site_address')) {
                $table->text('site_address')->nullable()->after('header_email');
            }

            if (! Schema::hasColumn('site_settings', 'seo_google_verification')) {
                $table->string('seo_google_verification', 100)->nullable()->after('social_links');
            }
            if (! Schema::hasColumn('site_settings', 'seo_gtm_id')) {
                $table->string('seo_gtm_id', 50)->nullable()->after('seo_google_verification');
            }
            if (! Schema::hasColumn('site_settings', 'seo_gtag_id')) {
                $table->string('seo_gtag_id', 50)->nullable()->after('seo_gtm_id');
            }
            if (! Schema::hasColumn('site_settings', 'seo_default_meta_description')) {
                $table->text('seo_default_meta_description')->nullable()->after('seo_gtag_id');
            }
            if (! Schema::hasColumn('site_settings', 'seo_default_meta_keywords')) {
                $table->text('seo_default_meta_keywords')->nullable()->after('seo_default_meta_description');
            }
            if (! Schema::hasColumn('site_settings', 'seo_og_image')) {
                $table->string('seo_og_image')->nullable()->after('seo_default_meta_keywords');
            }
            if (! Schema::hasColumn('site_settings', 'seo_schema_json')) {
                $table->longText('seo_schema_json')->nullable()->after('seo_og_image');
            }

            foreach ([
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
            ] as $column) {
                if (! Schema::hasColumn('site_settings', $column)) {
                    $table->string($column, 7)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            foreach ([
                'site_address',
                'seo_google_verification',
                'seo_gtm_id',
                'seo_gtag_id',
                'seo_default_meta_description',
                'seo_default_meta_keywords',
                'seo_og_image',
                'seo_schema_json',
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
            ] as $column) {
                if (Schema::hasColumn('site_settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
