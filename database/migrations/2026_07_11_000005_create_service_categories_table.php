<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('service_category_id')->nullable()->after('slug')->constrained('service_categories')->nullOnDelete();
        });

        if (Schema::hasColumn('services', 'category')) {
            $services = DB::table('services')->whereNotNull('category')->get(['id', 'category']);

            foreach ($services as $service) {
                $name = trim((string) $service->category);
                if ($name === '') {
                    continue;
                }

                $slug = Str::slug($name) ?: 'category';
                $categoryId = DB::table('service_categories')->where('slug', $slug)->value('id');

                if (! $categoryId) {
                    $categoryId = DB::table('service_categories')->insertGetId([
                        'name' => $name,
                        'slug' => $this->uniqueCategorySlug($slug),
                        'sort_order' => 0,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('services')->where('id', $service->id)->update([
                    'service_category_id' => $categoryId,
                ]);
            }

            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('category')->nullable()->after('slug');
        });

        $services = DB::table('services')
            ->join('service_categories', 'services.service_category_id', '=', 'service_categories.id')
            ->get(['services.id', 'service_categories.name']);

        foreach ($services as $service) {
            DB::table('services')->where('id', $service->id)->update(['category' => $service->name]);
        }

        Schema::table('services', function (Blueprint $table) {
            $table->dropConstrainedForeignId('service_category_id');
        });

        Schema::dropIfExists('service_categories');
    }

    private function uniqueCategorySlug(string $base): string
    {
        $slug = $base;
        $original = $base;
        $counter = 1;

        while (DB::table('service_categories')->where('slug', $slug)->exists()) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
};
