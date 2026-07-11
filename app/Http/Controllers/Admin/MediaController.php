<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Get images by section type
     */
    public function getBySectionType(Request $request, $sectionType = null)
    {
        $query = Media::where('file_type', 'image');
        
        if ($sectionType) {
            $query->where(function($q) use ($sectionType) {
                $q->where('section_type', $sectionType)
                  ->orWhereNull('section_type');
            });
        }
        
        $images = $query->orderBy('created_at', 'desc')->get();
        
        return response()->json($images->map(function($image) {
            return [
                'id' => $image->id,
                'name' => $image->name,
                'url' => $image->url,
                'file_path' => $image->file_path,
                'section_type' => $image->section_type,
            ];
        }));
    }

    /**
     * Upload and store image
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:5120',
            'section_type' => 'nullable|string',
            'name' => 'nullable|string|max:255',
        ]);

        $file = $request->file('image');
        $name = $request->input('name') ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        
        // Move to uploads/pages/images
        $destination = public_path('uploads/pages/images');
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $safeName = Str::slug($name);
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '-' . $safeName . '.' . $extension;
        $file->move($destination, $filename);
        
        $filePath = 'uploads/pages/images/' . $filename;

        $media = Media::create([
            'name' => $name,
            'file_path' => $filePath,
            'file_type' => 'image',
            'section_type' => $request->input('section_type'),
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ]);

        return response()->json([
            'id' => $media->id,
            'name' => $media->name,
            'url' => $media->url,
            'file_path' => $media->file_path,
        ]);
    }

    /**
     * Scan existing uploads folder and add to database
     */
    public function scanUploads()
    {
        $uploadPath = public_path('uploads/pages/images');
        $files = [];
        
        if (is_dir($uploadPath)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($uploadPath)
            );
            
            foreach ($iterator as $file) {
                if ($file->isFile() && in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $relativePath = 'uploads/pages/images/' . $file->getFilename();
                    
                    // Check if already exists
                    if (!Media::where('file_path', $relativePath)->exists()) {
                        Media::create([
                            'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                            'file_path' => $relativePath,
                            'file_type' => 'image',
                            'file_size' => $file->getSize(),
                            'mime_type' => mime_content_type($file->getPathname()),
                        ]);
                    }
                }
            }
        }
        
        return response()->json(['message' => 'Uploads scanned successfully']);
    }
}
