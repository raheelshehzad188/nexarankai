<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->string('category')->nullable()->after('slug');
            $table->text('excerpt')->nullable()->after('description');
            $table->longText('content')->nullable()->after('excerpt');
            $table->string('image_alt')->nullable()->after('image');
            $table->string('content_image')->nullable()->after('image_alt');
            $table->string('icon_url')->nullable()->after('content_image');
            $table->date('published_at')->nullable()->after('icon_url');
            $table->unsignedInteger('sort_order')->default(0)->after('published_at');
            $table->string('features_section_title')->nullable()->after('sort_order');
            $table->json('accordions')->nullable()->after('features_section_title');
            $table->string('brochure_doc_url')->nullable()->after('accordions');
            $table->string('brochure_pdf_url')->nullable()->after('brochure_doc_url');
            $table->json('sidebar_testimonials')->nullable()->after('brochure_pdf_url');
            $table->string('meta_title')->nullable()->after('sidebar_testimonials');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->text('meta_keywords')->nullable()->after('meta_description');
            $table->string('og_title')->nullable()->after('meta_keywords');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->after('og_description');
            $table->string('canonical_url')->nullable()->after('og_image');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'category', 'excerpt', 'content', 'image_alt', 'content_image',
                'icon_url', 'published_at', 'sort_order', 'features_section_title',
                'accordions', 'brochure_doc_url', 'brochure_pdf_url', 'sidebar_testimonials',
                'meta_title', 'meta_description', 'meta_keywords', 'og_title',
                'og_description', 'og_image', 'canonical_url',
            ]);
        });
    }
};
