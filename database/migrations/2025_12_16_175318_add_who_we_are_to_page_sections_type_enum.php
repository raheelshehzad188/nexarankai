<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the enum to include 'who-we-are'
        DB::statement("ALTER TABLE page_sections MODIFY COLUMN type ENUM('hero', 'content', 'services', 'testimonials', 'clients', 'faq', 'video-hero', 'our-services', 'who-we-are') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'who-we-are' from enum
        DB::statement("ALTER TABLE page_sections MODIFY COLUMN type ENUM('hero', 'content', 'services', 'testimonials', 'clients', 'faq', 'video-hero', 'our-services') NOT NULL");
    }
};
