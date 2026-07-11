<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SitemapController;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,svg,jpeg|max:512',
            'header_phone' => 'nullable|string|max:255',
            'header_email' => 'nullable|email|max:255',
            'site_address' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:255',
            'header_cta_text' => 'nullable|string|max:255',
            'header_cta_link' => 'nullable|url|max:255',
            'footer_text' => 'nullable|string',
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_nadca' => 'nullable|url|max:255',
            'color_pro_clean_blue' => 'nullable|string|max:7',
            'color_pro_clean_red' => 'nullable|string|max:7',
            'color_primary_1' => 'nullable|string|max:7',
            'color_primary_2' => 'nullable|string|max:7',
            'color_primary_3' => 'nullable|string|max:7',
            'color_gray_1' => 'nullable|string|max:7',
            'color_gray_2' => 'nullable|string|max:7',
            'color_gray_3' => 'nullable|string|max:7',
            'color_gray_4' => 'nullable|string|max:7',
            'color_white' => 'nullable|string|max:7',
            'color_success' => 'nullable|string|max:7',
            'color_warning' => 'nullable|string|max:7',
            'color_danger' => 'nullable|string|max:7',
            'color_lime_green' => 'nullable|string|max:7',
            // SEO
            'seo_google_verification' => 'nullable|string|max:100',
            'seo_gtm_id' => 'nullable|string|max:50',
            'seo_gtag_id' => 'nullable|string|max:50',
            'seo_default_meta_description' => 'nullable|string|max:500',
            'seo_default_meta_keywords' => 'nullable|string|max:500',
            'seo_og_image' => 'nullable|image|max:2048',
            'seo_schema_json' => 'nullable|string',
        ]);

        if ($request->hasFile('site_logo')) {
            $existingLogo = SiteSetting::first()?->site_logo;
            $validated['site_logo'] = $this->moveUpload($request->file('site_logo'), 'site', $existingLogo);
        }

        if ($request->hasFile('favicon')) {
            $existingFavicon = SiteSetting::first()?->favicon;
            $validated['favicon'] = $this->moveUpload($request->file('favicon'), 'site', $existingFavicon);
        }

        if ($request->hasFile('seo_og_image')) {
            $existingOg = SiteSetting::first()?->seo_og_image;
            $validated['seo_og_image'] = $this->moveUpload($request->file('seo_og_image'), 'site', $existingOg);
        }

        if (!empty($validated['seo_schema_json'])) {
            json_decode($validated['seo_schema_json']);
            if (json_last_error() !== JSON_ERROR_NONE) {
                unset($validated['seo_schema_json']);
            }
        }

        $socialLinks = [];
        if ($request->filled('social_facebook')) {
            $socialLinks[] = ['platform' => 'facebook', 'url' => $request->social_facebook];
        }
        if ($request->filled('social_instagram')) {
            $socialLinks[] = ['platform' => 'instagram', 'url' => $request->social_instagram];
        }
        if ($request->filled('social_youtube')) {
            $socialLinks[] = ['platform' => 'youtube', 'url' => $request->social_youtube];
        }
        if ($request->filled('social_nadca')) {
            $socialLinks[] = ['platform' => 'nadca', 'url' => $request->social_nadca];
        }
        $validated['social_links'] = $socialLinks;

        unset($validated['social_facebook'], $validated['social_instagram'], $validated['social_youtube'], $validated['social_nadca']);

        $settings = SiteSetting::first();
        if ($settings) {
            $settings->update($validated);
        } else {
            SiteSetting::create($validated);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully!');
    }

    public function generateSitemap(SitemapController $sitemapController)
    {
        try {
            $sitemapUrl = $sitemapController->generate();
            return redirect()->route('admin.settings.edit')
                ->with('success', 'Sitemap generated successfully!')
                ->with('sitemap_url', $sitemapUrl);
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.edit')
                ->with('error', 'Failed to generate sitemap: ' . $e->getMessage());
        }
    }

    private function moveUpload($file, string $folder, ?string $oldPath = null): string
    {
        $destination = public_path('uploads/' . $folder);
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        if ($oldPath) {
            $this->deleteUpload($oldPath);
        }

        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($name);
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '-' . $safeName . '.' . $extension;

        $file->move($destination, $filename);

        return 'uploads/' . $folder . '/' . $filename;
    }

    private function deleteUpload(?string $path): void
    {
        if (!$path) {
            return;
        }

        $relative = Str::startsWith($path, 'uploads/') ? $path : 'uploads/' . ltrim($path, '/');

        $publicPath = public_path($relative);
        if (file_exists($publicPath)) {
            @unlink($publicPath);
            return;
        }

        $storagePath = storage_path('app/public/' . ltrim($path, '/'));
        if (file_exists($storagePath)) {
            @unlink($storagePath);
        }
    }
}
