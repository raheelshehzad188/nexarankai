<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Service;
use Illuminate\Http\Request;

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
        return view('admin.page-sections.create', compact('pages', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|in:hero,video-hero,content,services,testimonials,clients,faq,our-services,who-we-are',
            'data' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200', // 50MB max
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
            $videoPath = $videoFile->store('videos', 'public');
            $data['video_file'] = $videoPath;
            $data['video_source'] = 'upload';
        } elseif (isset($data['video_source']) && $data['video_source'] === 'upload' && !$request->hasFile('video_file')) {
            // If video source is upload but no file provided, keep existing or set to null
            $data['video_file'] = null;
        }

        // Handle image file upload for trusted-partner type
        if ($request->input('type') === 'trusted-partner' && $request->hasFile('image_file')) {
            $imageFile = $request->file('image_file');
            $imagePath = $imageFile->store('images', 'public');
            $data['image'] = $imagePath;
            $data['image_source'] = 'upload';
        } elseif (isset($data['image_source']) && $data['image_source'] === 'upload' && !$request->hasFile('image_file')) {
            // If image source is upload but no file provided, keep existing or set to null
            $data['image'] = null;
        }

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
        return view('admin.page-sections.edit', compact('pageSection', 'pages', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageSection $pageSection)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|in:hero,video-hero,content,services,testimonials,clients,faq,our-services,who-we-are,trusted-partner',
            'data' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200', // 50MB max
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
                $oldVideoPath = storage_path('app/public/' . $pageSection->data['video_file']);
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }
            
            $videoFile = $request->file('video_file');
            $videoPath = $videoFile->store('videos', 'public');
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
                $oldImagePath = storage_path('app/public/' . $pageSection->data['image']);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $imageFile = $request->file('image_file');
            $imagePath = $imageFile->store('images', 'public');
            $data['image'] = $imagePath;
            $data['image_source'] = 'upload';
        } elseif (isset($data['image_source']) && $data['image_source'] === 'upload' && !$request->hasFile('image_file')) {
            // Keep existing image file if not uploading new one
            if (isset($pageSection->data['image'])) {
                $data['image'] = $pageSection->data['image'];
            }
        }

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
        $pageSection->delete();
        return redirect()->route('admin.page-sections.index')->with('success', 'Page section deleted successfully!');
    }
}
