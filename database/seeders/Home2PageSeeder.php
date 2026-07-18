<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionType;
use Illuminate\Database\Seeder;

class Home2PageSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['slug' => 'irhas-page-banner', 'name' => 'Irhas - Page Top Banner'],
            ['slug' => 'irhas2-hero', 'name' => 'Home2 - Hero'],
            ['slug' => 'irhas2-features', 'name' => 'Home2 - Features'],
            ['slug' => 'irhas2-portfolio', 'name' => 'Home2 - Portfolio'],
            ['slug' => 'irhas2-about-video', 'name' => 'Home2 - About Video'],
            ['slug' => 'irhas2-team', 'name' => 'Home2 - Team'],
            ['slug' => 'irhas2-testimonial', 'name' => 'Home2 - Testimonial'],
            ['slug' => 'irhas2-blog', 'name' => 'Home2 - Blog'],
        ];

        foreach ($types as $index => $type) {
            SectionType::updateOrCreate(
                ['slug' => $type['slug']],
                [
                    'name' => $type['name'],
                    'description' => $type['name'] . ' section.',
                    'status' => true,
                    'sort_order' => 100 + $index,
                ]
            );
        }

        $page = Page::updateOrCreate(
            ['slug' => 'home2'],
            [
                'title' => 'Home 2',
                'meta_title' => 'Home 2 - Irhas',
                'meta_description' => 'Irhas Home 2 layout page.',
                'status' => 'published',
                'use_new_layout' => false,
                'use_irhas_layout' => false,
                'use_irhas2_layout' => true,
            ]
        );

        PageSection::where('page_id', $page->id)->delete();

        $home2Sections = [
            'irhas2-hero',
            'irhas2-features',
            'irhas2-portfolio',
            'irhas2-about-video',
            'irhas2-team',
            'irhas2-testimonial',
            'irhas2-blog',
        ];

        foreach ($home2Sections as $index => $type) {
            PageSection::create([
                'page_id' => $page->id,
                'type' => $type,
                'data' => config('irhas_defaults.' . $type, []),
                'sort_order' => $index + 1,
                'status' => true,
            ]);
        }

        $banners = [
            'services' => [
                'eyebrow' => 'Service',
                'title' => 'What We Have.',
                'background_image' => 'img/banner-header-service.png',
            ],
            'blog' => [
                'eyebrow' => 'Blog',
                'title' => 'Our Journal',
                'background_image' => 'img/banner-header-service.png',
            ],
        ];

        foreach ($banners as $slug => $bannerData) {
            $target = Page::where('slug', $slug)->first();
            if (! $target) {
                continue;
            }

            if (! $target->sections()->where('type', 'irhas-page-banner')->exists()) {
                $target->sections()->increment('sort_order');
                PageSection::create([
                    'page_id' => $target->id,
                    'type' => 'irhas-page-banner',
                    'data' => $bannerData,
                    'sort_order' => 1,
                    'status' => true,
                ]);
            }
        }

        $this->command?->info('Home2 page ready at /home2 with ' . count($home2Sections) . ' sections.');
    }
}
