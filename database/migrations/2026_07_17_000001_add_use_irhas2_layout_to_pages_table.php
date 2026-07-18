<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (! Schema::hasColumn('pages', 'use_irhas2_layout')) {
                $table->boolean('use_irhas2_layout')->default(false)->after('use_irhas_layout');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'use_irhas2_layout')) {
                $table->dropColumn('use_irhas2_layout');
            }
        });
    }
};
