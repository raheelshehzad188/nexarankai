<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Service;
use App\Models\SectionType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = PageSection::with('page')->orderBy('page_id')->orderBy('sort_order')->get();
        return view('admin.page-sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pages = Page::where('status', 'published')->get();
        $services = Service::where('status', true)->orderBy('title')->get();
        $sectionTypes = SectionType::where('status', true)->orderBy('sort_order')->orderBy('name')->get();
        return view('admin.page-sections.create', compact('pages', 'services', 'sectionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|in:hero,video-hero,content,services,testimonials,clients,faq,our-services,who-we-are,trusted-partner,contact-form,what-we-do,pro-clean,plan-visit,about-hero,home-hero,free-quotation,about-top-content,about-2nd-section,about-services-section,about-ct-section,service-top-section,service-below-section,service-3rd-section,service-4th-blue-section,service-4th-section,service-form-section,contact-page-section,new-full,new-design-hero,new-design-promise,new-design-difference,new-design-included,new-design-process,new-design-results,new-design-breathe,new-design-nadca,new-design-areas,new-design-pricing,new-design-quote,new-design-privacy-hero,new-design-privacy-content,irhas-about,irhas-portfolio,irhas-services,irhas-testimonial,irhas-counter,irhas-blog,irhas-services-list,irhas-blog-list,irhas-contact,irhas-page-banner,irhas2-hero,irhas2-features,irhas2-portfolio,irhas2-about-video,irhas2-team,irhas2-testimonial,irhas2-blog',
            'data' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200', // 50MB max
            'image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'about_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'home_background_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'home_logo_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'contact_hero_bg_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'new_design_background_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Handle data field - decode JSON string to array
        $data = [];
        if ($request->has('data') && !empty($request->input('data'))) {
            $decoded = json_decode($request->input('data'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data = $decoded;
            }
        }

        // Handle video file upload for video-hero type
        if ($request->input('type') === 'video-hero' && $request->hasFile('video_file')) {
            $videoFile = $request->file('video_file');
            $videoPath = $this->moveUpload($videoFile, 'pages/videos');
            $data['video_file'] = $videoPath;
            $data['video_source'] = 'upload';
        } elseif (isset($data['video_source']) && $data['video_source'] === 'upload' && !$request->hasFile('video_file')) {
            // If video source is upload but no file provided, keep existing or set to null
            $data['video_file'] = null;
        }

        // Handle image file upload for trusted-partner type
        if ($request->input('type') === 'trusted-partner' && $request->hasFile('image_file')) {
            $imageFile = $request->file('image_file');
            $imagePath = $this->moveUpload($imageFile, 'pages/images');
            $data['image'] = $imagePath;
            $data['image_source'] = 'upload';
        } elseif (isset($data['image_source']) && $data['image_source'] === 'upload' && !$request->hasFile('image_file')) {
            // If image source is upload but no file provided, keep existing or set to null
            $data['image'] = null;
        }

        // Handle banner image upload for about-hero type
        if ($request->input('type') === 'about-hero' && $request->hasFile('about_image_file')) {
            $aboutImage = $request->file('about_image_file');
            $aboutImagePath = $this->moveUpload($aboutImage, 'pages/images');
            $data['image'] = $aboutImagePath;
            $data['image_source'] = 'upload';
        } elseif ($request->input('type') === 'about-hero' && ($data['image_source'] ?? '') === 'upload' && !$request->hasFile('about_image_file')) {
            $data['image'] = $data['image'] ?? null;
        }

        // Handle background image upload for home-hero type
        if ($request->input('type') === 'home-hero' && $request->hasFile('home_background_image_file')) {
            $homeBgImage = $request->file('home_background_image_file');
            $homeBgImagePath = $this->moveUpload($homeBgImage, 'pages/images');
            $data['background_image'] = $homeBgImagePath;
            $data['image_source'] = 'upload';
        } elseif ($request->input('type') === 'home-hero' && ($data['image_source'] ?? '') === 'upload' && !$request->hasFile('home_background_image_file')) {
            $data['background_image'] = $data['background_image'] ?? null;
        }

        // Handle logo image upload for home-hero type
        if ($request->input('type') === 'home-hero' && $request->hasFile('home_logo_image_file')) {
            $homeLogoImage = $request->file('home_logo_image_file');
            $homeLogoImagePath = $this->moveUpload($homeLogoImage, 'pages/images');
            $data['logo_image'] = $homeLogoImagePath;
            $data['logo_image_source'] = 'upload';
        } elseif ($request->input('type') === 'home-hero' && ($data['logo_image_source'] ?? '') === 'upload' && !$request->hasFile('home_logo_image_file')) {
            $data['logo_image'] = $data['logo_image'] ?? null;
        }

        // Handle image upload for service-3rd-section type
        if ($request->input('type') === 'service-3rd-section' && $request->hasFile('service_3rd_image_file')) {
            $service3rdImage = $request->file('service_3rd_image_file');
            $service3rdImagePath = $this->moveUpload($service3rdImage, 'pages/images');
            $data['image'] = $service3rdImagePath;
            $data['image_source'] = 'upload';
        } elseif ($request->input('type') === 'service-3rd-section' && ($data['image_source'] ?? '') === 'upload' && !$request->hasFile('service_3rd_image_file')) {
            $data['image'] = $data['image'] ?? null;
        }

        // Handle image upload for about-services-section type
        if ($request->input('type') === 'about-services-section' && $request->hasFile('about_services_image_file')) {
            $aboutServicesImage = $request->file('about_services_image_file');
            $aboutServicesImagePath = $this->moveUpload($aboutServicesImage, 'pages/images');
            $data['image'] = $aboutServicesImagePath;
            $data['image_source'] = 'upload';
            $data['image_url'] = null;
        } elseif ($request->input('type') === 'about-services-section') {
            if (isset($data['image_source']) && $data['image_source'] === 'url') {
                // Using URL, clear upload
                $data['image'] = null;
            } elseif (($data['image_source'] ?? 'upload') === 'upload') {
                // Using upload but no file provided
                $data['image'] = null;
                $data['image_url'] = null;
            }
        }

        // Handle hero background image upload for contact-page-section type
        if ($request->input('type') === 'contact-page-section' && $request->hasFile('contact_hero_bg_image_file')) {
            $contactHeroBgImage = $request->file('contact_hero_bg_image_file');
            $contactHeroBgImagePath = $this->moveUpload($contactHeroBgImage, 'pages/images');
            $data['hero_bg_image'] = $contactHeroBgImagePath;
            $data['hero_bg_image_source'] = 'upload';
            $data['hero_bg_image_url'] = null;
        } elseif ($request->input('type') === 'contact-page-section') {
            if (isset($data['hero_bg_image_source']) && $data['hero_bg_image_source'] === 'url') {
                // Using URL, clear upload
                $data['hero_bg_image'] = null;
            } elseif (($data['hero_bg_image_source'] ?? 'upload') === 'upload') {
                // Using upload but no file provided
                $data['hero_bg_image'] = $data['hero_bg_image'] ?? null;
                $data['hero_bg_image_url'] = null;
            }
        }

        $data = $this->handleNewDesignSectionData($request, $data);

        $validated['data'] = $data;

        // Convert status checkbox to boolean
        $validated['status'] = $request->has('status') && $request->input('status') == '1';

        PageSection::create($validated);
        return redirect()->route('admin.page-sections.index')->with('success', 'Page section created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageSection $pageSection)
    {
        $pages = Page::where('status', 'published')->get();
        $services = Service::where('status', true)->orderBy('title')->get();
        $sectionTypes = SectionType::where('status', true)->orderBy('sort_order')->orderBy('name')->get();
        return view('admin.page-sections.edit', compact('pageSection', 'pages', 'services', 'sectionTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageSection $pageSection)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|in:hero,video-hero,content,services,testimonials,clients,faq,our-services,who-we-are,trusted-partner,contact-form,what-we-do,pro-clean,plan-visit,about-hero,home-hero,free-quotation,about-top-content,about-2nd-section,about-services-section,about-ct-section,service-top-section,service-below-section,service-3rd-section,service-4th-blue-section,service-4th-section,service-form-section,contact-page-section,new-full,new-design-hero,new-design-promise,new-design-difference,new-design-included,new-design-process,new-design-results,new-design-breathe,new-design-nadca,new-design-areas,new-design-pricing,new-design-quote,new-design-privacy-hero,new-design-privacy-content,irhas-about,irhas-portfolio,irhas-services,irhas-testimonial,irhas-counter,irhas-blog,irhas-services-list,irhas-blog-list,irhas-contact,irhas-page-banner,irhas2-hero,irhas2-features,irhas2-portfolio,irhas2-about-video,irhas2-team,irhas2-testimonial,irhas2-blog',
            'data' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200', // 50MB max
            'image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'about_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'home_background_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'home_logo_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'contact_hero_bg_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'new_design_background_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Handle data field - decode JSON string to array
        $data = [];
        if ($request->has('data') && !empty($request->input('data'))) {
            $decoded = json_decode($request->input('data'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data = $decoded;
            }
        }

        // Handle video file upload for video-hero type
        if ($request->input('type') === 'video-hero' && $request->hasFile('video_file')) {
            // Delete old video file if exists
            if (isset($pageSection->data['video_file']) && $pageSection->data['video_file']) {
                $this->deleteUpload($pageSection->data['video_file']);
            }
            
            $videoFile = $request->file('video_file');
            $videoPath = $this->moveUpload($videoFile, 'pages/videos');
            $data['video_file'] = $videoPath;
            $data['video_source'] = 'upload';
        } elseif (isset($data['video_source']) && $data['video_source'] === 'upload' && !$request->hasFile('video_file')) {
            // Keep existing video file if not uploading new one
            if (isset($pageSection->data['video_file'])) {
                $data['video_file'] = $pageSection->data['video_file'];
            }
        }

        // Handle image file upload for trusted-partner type
        if ($request->input('type') === 'trusted-partner' && $request->hasFile('image_file')) {
            // Delete old image file if exists
            if (isset($pageSection->data['image']) && $pageSection->data['image']) {
                $this->deleteUpload($pageSection->data['image']);
            }
            
            $imageFile = $request->file('image_file');
            $imagePath = $this->moveUpload($imageFile, 'pages/images');
            $data['image'] = $imagePath;
            $data['image_source'] = 'upload';
        } elseif (isset($data['image_source']) && $data['image_source'] === 'upload' && !$request->hasFile('image_file')) {
            // Keep existing image file if not uploading new one
            if (isset($pageSection->data['image'])) {
                $data['image'] = $pageSection->data['image'];
            }
        }

        // Handle banner image upload for about-hero type
        if ($request->input('type') === 'about-hero' && $request->hasFile('about_image_file')) {
            if (isset($pageSection->data['image']) && $pageSection->data['image']) {
                $this->deleteUpload($pageSection->data['image']);
            }

            $aboutImage = $request->file('about_image_file');
            $aboutImagePath = $this->moveUpload($aboutImage, 'pages/images');
            $data['image'] = $aboutImagePath;
            $data['image_source'] = 'upload';
        } elseif ($request->input('type') === 'about-hero' && ($data['image_source'] ?? '') === 'upload' && !$request->hasFile('about_image_file')) {
            if (isset($pageSection->data['image'])) {
                $data['image'] = $pageSection->data['image'];
            }
        }

        // Handle background image upload for home-hero type
        if ($request->input('type') === 'home-hero' && $request->hasFile('home_background_image_file')) {
            if (isset($pageSection->data['background_image']) && $pageSection->data['background_image']) {
                $this->deleteUpload($pageSection->data['background_image']);
            }

            $homeBgImage = $request->file('home_background_image_file');
            $homeBgImagePath = $this->moveUpload($homeBgImage, 'pages/images');
            $data['background_image'] = $homeBgImagePath;
            $data['image_source'] = 'upload';
        } elseif ($request->input('type') === 'home-hero' && ($data['image_source'] ?? '') === 'upload' && !$request->hasFile('home_background_image_file')) {
            if (isset($pageSection->data['background_image'])) {
                $data['background_image'] = $pageSection->data['background_image'];
            }
        }

        // Handle logo image upload for home-hero type
        if ($request->input('type') === 'home-hero' && $request->hasFile('home_logo_image_file')) {
            if (isset($pageSection->data['logo_image']) && $pageSection->data['logo_image']) {
                $this->deleteUpload($pageSection->data['logo_image']);
            }

            $homeLogoImage = $request->file('home_logo_image_file');
            $homeLogoImagePath = $this->moveUpload($homeLogoImage, 'pages/images');
            $data['logo_image'] = $homeLogoImagePath;
            $data['logo_image_source'] = 'upload';
        } elseif ($request->input('type') === 'home-hero' && ($data['logo_image_source'] ?? '') === 'upload' && !$request->hasFile('home_logo_image_file')) {
            if (isset($pageSection->data['logo_image'])) {
                $data['logo_image'] = $pageSection->data['logo_image'];
            }
        }

        // Handle image upload for service-3rd-section type
        if ($request->input('type') === 'service-3rd-section' && $request->hasFile('service_3rd_image_file')) {
            if (isset($pageSection->data['image']) && $pageSection->data['image']) {
                $this->deleteUpload($pageSection->data['image']);
            }

            $service3rdImage = $request->file('service_3rd_image_file');
            $service3rdImagePath = $this->moveUpload($service3rdImage, 'pages/images');
            $data['image'] = $service3rdImagePath;
            $data['image_source'] = 'upload';
        } elseif ($request->input('type') === 'service-3rd-section' && ($data['image_source'] ?? '') === 'upload' && !$request->hasFile('service_3rd_image_file')) {
            if (isset($pageSection->data['image'])) {
                $data['image'] = $pageSection->data['image'];
            }
        }

        // Handle image upload for about-services-section type
        if ($request->input('type') === 'about-services-section' && $request->hasFile('about_services_image_file')) {
            if (isset($pageSection->data['image']) && $pageSection->data['image']) {
                $this->deleteUpload($pageSection->data['image']);
            }

            $aboutServicesImage = $request->file('about_services_image_file');
            $aboutServicesImagePath = $this->moveUpload($aboutServicesImage, 'pages/images');
            $data['image'] = $aboutServicesImagePath;
            $data['image_source'] = 'upload';
            $data['image_url'] = null;
        } elseif ($request->input('type') === 'about-services-section') {
            if (isset($data['image_source']) && $data['image_source'] === 'url') {
                // Using URL, clear upload
                $data['image'] = null;
            } elseif (($data['image_source'] ?? 'upload') === 'upload') {
                // Using upload, keep existing image if no new file
                if (!$request->hasFile('about_services_image_file') && isset($pageSection->data['image'])) {
                    $data['image'] = $pageSection->data['image'];
                }
                $data['image_url'] = null;
            }
        }

        $data = $this->handleNewDesignSectionData($request, $data, $pageSection);

        $validated['data'] = $data;

        // Convert status checkbox to boolean
        $validated['status'] = $request->has('status') && $request->input('status') == '1';

        $pageSection->update($validated);
        return redirect()->route('admin.page-sections.index')->with('success', 'Page section updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageSection $pageSection)
    {
        // Clean up associated uploads if any
        if (isset($pageSection->data['video_file'])) {
            $this->deleteUpload($pageSection->data['video_file']);
        }
        if (isset($pageSection->data['image']) && ($pageSection->data['image_source'] ?? 'upload') === 'upload') {
            $this->deleteUpload($pageSection->data['image']);
        }
        if (isset($pageSection->data['background_image'])) {
            $this->deleteUpload($pageSection->data['background_image']);
        }
        if (isset($pageSection->data['logo_image'])) {
            $this->deleteUpload($pageSection->data['logo_image']);
        }

        $pageSection->delete();
        return redirect()->route('admin.page-sections.index')->with('success', 'Page section deleted successfully!');
    }

    private function handleNewDesignSectionData(Request $request, array $data, ?PageSection $existing = null): array
    {
        $type = $request->input('type');
        if (! is_string($type) || ! str_starts_with($type, 'new-design-')) {
            return $data;
        }

        $source = $data['background_image_source'] ?? 'url';

        if ($request->hasFile('new_design_background_image_file')) {
            if ($existing && ! empty($existing->data['background_image'])) {
                $this->deleteUpload($existing->data['background_image']);
            }

            $data['background_image'] = $this->moveUpload(
                $request->file('new_design_background_image_file'),
                'pages/images'
            );
            $data['background_image_source'] = 'upload';
            $data['background_image_url'] = null;
        } elseif ($source === 'upload' && $existing && ! empty($existing->data['background_image'])) {
            $data['background_image'] = $existing->data['background_image'];
        }

        return $data;
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
