<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (! Schema::hasColumn('pages', 'og_title')) {
                $table->string('og_title')->nullable()->after('meta_keywords');
            }
            if (! Schema::hasColumn('pages', 'og_description')) {
                $table->text('og_description')->nullable()->after('og_title');
            }
            if (! Schema::hasColumn('pages', 'og_image')) {
                $table->string('og_image')->nullable()->after('og_description');
            }
            if (! Schema::hasColumn('pages', 'canonical_url')) {
                $table->string('canonical_url')->nullable()->after('og_image');
            }
            if (! Schema::hasColumn('pages', 'schema_markup')) {
                $table->longText('schema_markup')->nullable()->after('canonical_url');
            }
            if (! Schema::hasColumn('pages', 'schema_type')) {
                $table->string('schema_type', 50)->nullable()->after('schema_markup');
            }
            if (! Schema::hasColumn('pages', 'schema_service_type')) {
                $table->string('schema_service_type', 100)->nullable()->after('schema_type');
            }
            if (! Schema::hasColumn('pages', 'schema_area_locality')) {
                $table->string('schema_area_locality', 100)->nullable()->after('schema_service_type');
            }
            if (! Schema::hasColumn('pages', 'schema_area_country')) {
                $table->string('schema_area_country', 100)->nullable()->after('schema_area_locality');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $cols = [
                'og_title',
                'og_description',
                'og_image',
                'canonical_url',
                'schema_markup',
                'schema_type',
                'schema_service_type',
                'schema_area_locality',
                'schema_area_country',
            ];

            foreach ($cols as $col) {
                if (Schema::hasColumn('pages', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
