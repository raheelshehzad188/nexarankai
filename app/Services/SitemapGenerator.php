<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Service;

class SitemapGenerator
{
    public function generate(): string
    {
        $baseUrl = rtrim(url('/'), '/');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        $addedUrls = [];
        $addUrl = function (string $path, string $lastmod, float $priority) use (&$xml, $baseUrl, &$addedUrls) {
            $path = trim($path, '/');
            $url = $baseUrl . '/' . ($path ?: '');
            $normalized = rtrim($url, '/') ?: $url;

            if (in_array($normalized, $addedUrls)) {
                return;
            }
            $addedUrls[] = $normalized;

            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $lastmod . '</lastmod>' . "\n";
            $xml .= '    <changefreq>daily</changefreq>' . "\n";
            $xml .= '    <priority>' . $priority . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        };

        $addUrl('', date('Y-m-d'), 1.0);
        $addUrl('contact', date('Y-m-d'), 0.8);

        $pages = Page::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($pages as $page) {
            if ($page->slug === 'home' || $page->slug === '') {
                continue;
            }
            $addUrl($page->slug, $page->updated_at->format('Y-m-d'), 0.7);
        }

        $services = Service::where('status', true)
            ->whereNotNull('slug')
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($services as $service) {
            $addUrl('services/' . $service->slug, $service->updated_at->format('Y-m-d'), 0.6);
        }

        $blogPosts = BlogPost::published()
            ->whereNotNull('slug')
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($blogPosts as $post) {
            $addUrl('blog/' . $post->slug, $post->updated_at->format('Y-m-d'), 0.6);
        }

        $xml .= '</urlset>';

        $sitemapPath = public_path('sitemap.xml');

        if (!is_writable(public_path())) {
            throw new \Exception('Public directory is not writable.');
        }

        if (file_put_contents($sitemapPath, $xml) === false) {
            throw new \Exception('Failed to write sitemap.xml');
        }

        return $baseUrl . '/sitemap.xml';
    }
}
