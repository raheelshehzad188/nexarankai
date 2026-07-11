<?php

namespace App\Http\Controllers;

use App\Services\SitemapGenerator;

class SitemapController extends Controller
{
    public function generate(): string
    {
        return app(SitemapGenerator::class)->generate();
    }

    public function update()
    {
        try {
            $url = $this->generate();
            return 'Sitemap updated! <a href="' . $url . '">View sitemap</a>';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
