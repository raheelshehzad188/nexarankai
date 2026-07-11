<?php

namespace App\Console\Commands;

use App\Http\Controllers\SitemapController;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap.xml for search engines';

    public function handle(SitemapController $sitemapController): int
    {
        try {
            $url = $sitemapController->generate();
            $this->info("Sitemap generated successfully: {$url}");
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to generate sitemap: ' . $e->getMessage());
            return 1;
        }
    }
}
