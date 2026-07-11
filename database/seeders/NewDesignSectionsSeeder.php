<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionType;
use Illuminate\Database\Seeder;

class NewDesignSectionsSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['slug' => 'new-design-hero', 'name' => 'New design - Hero'],
            ['slug' => 'new-design-promise', 'name' => 'New design - Promise'],
            ['slug' => 'new-design-difference', 'name' => 'New design - Difference'],
            ['slug' => 'new-design-included', 'name' => 'New design - Included'],
            ['slug' => 'new-design-process', 'name' => 'New design - Process'],
            ['slug' => 'new-design-results', 'name' => 'New design - Results'],
            ['slug' => 'new-design-breathe', 'name' => 'New design - Breathe'],
            ['slug' => 'new-design-nadca', 'name' => 'New design - NADCA'],
            ['slug' => 'new-design-areas', 'name' => 'New design - Areas'],
            ['slug' => 'new-design-pricing', 'name' => 'New design - Pricing'],
            ['slug' => 'new-design-quote', 'name' => 'New design - Quote'],
            ['slug' => 'new-design-privacy-hero', 'name' => 'New design - Privacy Hero'],
            ['slug' => 'new-design-privacy-content', 'name' => 'New design - Privacy Content'],
        ];

        foreach ($sections as $index => $section) {
            SectionType::updateOrCreate(
                ['slug' => $section['slug']],
                [
                    'name' => $section['name'],
                    'description' => $section['name'] . ' section for the new layout design.',
                    'status' => true,
                    'sort_order' => 100 + $index,
                ]
            );
        }

        $page = Page::where('slug', 'new-full')->first();

        if (!$page) {
            $this->command?->warn('Page with slug "new-full" not found. Section types created only.');
            return;
        }

        PageSection::where('page_id', $page->id)->where('type', 'new-full')->delete();

        foreach ($sections as $index => $section) {
            PageSection::updateOrCreate(
                [
                    'page_id' => $page->id,
                    'type' => $section['slug'],
                ],
                [
                    'data' => config('new_design_defaults.' . $section['slug'], ['label' => $section['name']]),
                    'sort_order' => $index + 1,
                    'status' => true,
                ]
            );
        }

        $page->update(['use_new_layout' => true]);

        $this->command?->info('Created ' . count($sections) . ' New design section types and page sections for new-full.');
    }
}
