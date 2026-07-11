<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE page_sections MODIFY COLUMN type VARCHAR(100) NOT NULL');

        Schema::table('site_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('site_settings', 'site_name')) {
                $table->string('site_name')->nullable()->after('id');
            }
            if (! Schema::hasColumn('site_settings', 'favicon')) {
                $table->string('favicon')->nullable()->after('site_logo');
            }
            if (! Schema::hasColumn('site_settings', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('header_email');
            }
        });

        Schema::table('pages', function (Blueprint $table) {
            if (! Schema::hasColumn('pages', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
        });
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE page_sections MODIFY COLUMN type ENUM('hero','content','services','testimonials','clients','faq','video-hero','our-services','who-we-are','trusted-partner') NOT NULL");
    }
};
