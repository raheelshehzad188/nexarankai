<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class ContactBannerSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::where('slug', 'contact')->first();

        if (! $page) {
            $this->command?->warn('No contact page found.');

            return;
        }

        if ($page->sections()->where('type', 'irhas-page-banner')->exists()) {
            $this->command?->info('Contact banner already present.');

            return;
        }

        $page->sections()->increment('sort_order');

        PageSection::create([
            'page_id' => $page->id,
            'type' => 'irhas-page-banner',
            'data' => [
                'eyebrow' => 'Contact',
                'title' => 'Get In Touch',
                'background_image' => 'img/banner-header-service.png',
            ],
            'sort_order' => 1,
            'status' => true,
        ]);

        $this->command?->info('Contact top banner added.');
    }
}
