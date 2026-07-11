@extends('admin.layout')

@section('title', 'Edit Page Section')

@section('content')
@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
@endphp
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Page Section</h2>
    <a href="{{ route('admin.page-sections.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.page-sections.update', $pageSection) }}" method="POST" id="sectionForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="page_id" class="form-label">Page <span class="text-danger">*</span></label>
                <select class="form-select @error('page_id') is-invalid @enderror" id="page_id" name="page_id" required>
                    <option value="">Select a page</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}" {{ old('page_id', $pageSection->page_id) == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                    @endforeach
                </select>
                @error('page_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Section Type <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Select a section type</option>
                        @foreach($sectionTypes as $sectionType)
                            <option value="{{ $sectionType->slug }}" {{ old('type', $pageSection->type) == $sectionType->slug ? 'selected' : '' }}>{{ $sectionType->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#sectionTypeModal">
                        <i class="bi bi-images"></i> Browse with Images
                    </button>
                </div>
                <div id="selectedSectionTypeInfo" class="mt-2" style="display: none;">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <img id="selectedSectionImage" src="" alt="" class="me-3" style="max-width: 60px; max-height: 60px; object-fit: cover; border-radius: 4px;">
                                <div>
                                    <strong id="selectedSectionName"></strong>
                                    <p class="mb-0 text-muted small" id="selectedSectionDesc"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section Type Modal -->
            <div class="modal fade" id="sectionTypeModal" tabindex="-1" aria-labelledby="sectionTypeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sectionTypeModalLabel">Select Section Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                @foreach($sectionTypes as $sectionType)
                                    @php
                                        $imagePath = $sectionType->image 
                                            ? (\Illuminate\Support\Str::startsWith($sectionType->image, 'uploads/') 
                                                ? $sectionType->image 
                                                : 'uploads/' . ltrim($sectionType->image, '/'))
                                            : null;
                                    @endphp
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 section-type-card" data-slug="{{ $sectionType->slug }}" data-name="{{ $sectionType->name }}" data-desc="{{ $sectionType->description }}" data-image="{{ $imagePath ? asset($imagePath) : '' }}" style="cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                            @if($imagePath)
                                                <img src="{{ asset($imagePath) }}" class="card-img-top" alt="{{ $sectionType->name }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                                    <i class="bi bi-image" style="font-size: 2rem; color: #ccc;"></i>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <h6 class="card-title mb-1">{{ $sectionType->name }}</h6>
                                                @if($sectionType->description)
                                                    <p class="card-text small text-muted mb-0">{{ \Illuminate\Support\Str::limit($sectionType->description, 60) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3" id="dataFields">
                <!-- Dynamic fields based on type will be inserted here -->
            </div>

            <div class="mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $pageSection->sort_order) }}">
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $pageSection->status) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">
                        Active
                    </label>
                </div>
            </div>

            <input type="hidden" id="data_json" name="data" value="{{ json_encode(old('data', $pageSection->data ?? [])) }}">

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update Section
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
@include('admin.page-sections.partials.new-design-admin')
@include('admin.page-sections.partials.irhas-admin')
<script>
function destroyWysiwygEditors() {
    const container = document.getElementById('dataFields');
    if (!container) return;
    container.querySelectorAll('.wysiwyg-editor').forEach(el => {
        const id = el.id;
        if (id && typeof tinymce !== 'undefined') {
            const ed = tinymce.get(id);
            if (ed) ed.remove();
        }
    });
}
function initWysiwygEditors(retryCount) {
    retryCount = retryCount || 0;
    const container = document.getElementById('dataFields');
    if (!container) return;
    const editors = container.querySelectorAll('.wysiwyg-editor');
    if (editors.length === 0) return;
    editors.forEach(el => {
        const id = el.id || ('wysiwyg-' + Math.random().toString(36).substr(2, 9));
        if (!el.id) el.id = id;
    });
    if (typeof tinymce === 'undefined') {
        if (retryCount < 30) setTimeout(() => initWysiwygEditors(retryCount + 1), 200);
        return;
    }
    tinymce.init({
        selector: '#dataFields .wysiwyg-editor',
        height: 280,
        menubar: false,
        plugins: 'lists link code',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link | removeformat',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        promotion: false,
        branding: false
    });
}
function syncWysiwygEditors() {
    if (typeof tinymce !== 'undefined') tinymce.triggerSave();
}

const existingData = @json($pageSection->data ?? []);
const servicesData = @json($services);
const pagesData = @json($pages);
const siteName = @json($siteName);
const newDesignDefaults = @json(config('new_design_defaults', []));
const irhasDefaults = @json(config('irhas_defaults', []));
const pageSectionType = @json($pageSection->type);

function newDesignFormData(type) {
    if (type === pageSectionType && existingData && Object.keys(existingData).length > 0) {
        return existingData;
    }
    return newDesignDefaults[type] || {};
}

function irhasFormData(type) {
    if (type === pageSectionType && existingData && Object.keys(existingData).length > 0) {
        return existingData;
    }
    return irhasDefaults[type] || {};
}

// Handle section type selection from modal
document.querySelectorAll('.section-type-card').forEach(card => {
    card.addEventListener('click', function() {
        const slug = this.dataset.slug;
        const name = this.dataset.name;
        const desc = this.dataset.desc;
        const image = this.dataset.image;
        
        // Set dropdown value
        document.getElementById('type').value = slug;
        
        // Show selected section info
        if (image) {
            document.getElementById('selectedSectionImage').src = image;
            document.getElementById('selectedSectionImage').style.display = 'block';
        } else {
            document.getElementById('selectedSectionImage').style.display = 'none';
        }
        document.getElementById('selectedSectionName').textContent = name;
        document.getElementById('selectedSectionDesc').textContent = desc || '';
        document.getElementById('selectedSectionTypeInfo').style.display = 'block';
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('sectionTypeModal'));
        if (modal) {
            modal.hide();
        }
        
        // Update form fields
        updateDataFields();
    });
});

// Handle dropdown change
document.getElementById('type').addEventListener('change', function() {
    updateSelectedSectionInfo();
    updateDataFields();
});

// Update selected section info when dropdown changes
function updateSelectedSectionInfo() {
    const selectedSlug = document.getElementById('type').value;
    
    if (selectedSlug) {
        // Find matching card to get image
        const card = document.querySelector(`.section-type-card[data-slug="${selectedSlug}"]`);
        if (card) {
            const image = card.dataset.image;
            if (image) {
                document.getElementById('selectedSectionImage').src = image;
                document.getElementById('selectedSectionImage').style.display = 'block';
            } else {
                document.getElementById('selectedSectionImage').style.display = 'none';
            }
            document.getElementById('selectedSectionName').textContent = card.dataset.name;
            document.getElementById('selectedSectionDesc').textContent = card.dataset.desc || '';
            document.getElementById('selectedSectionTypeInfo').style.display = 'block';
        } else {
            document.getElementById('selectedSectionTypeInfo').style.display = 'none';
        }
    } else {
        document.getElementById('selectedSectionTypeInfo').style.display = 'none';
    }
}

// Initialize on page load
updateSelectedSectionInfo();

function updateDataFields() {
    destroyWysiwygEditors();
    const type = document.getElementById('type').value;
    const dataFields = document.getElementById('dataFields');
    const dataInput = document.getElementById('data_json');
    
    let html = '';
    
    if (type === 'hero') {
        html = `
            <label class="form-label">Hero Data</label>
            <div class="mb-2">
                <input type="text" class="form-control" id="data_title" placeholder="Title" value="${existingData.title || ''}">
            </div>
            <div class="mb-2">
                <input type="text" class="form-control" id="data_subtitle" placeholder="Subtitle" value="${existingData.subtitle || ''}">
            </div>
        `;
    } else if (type === 'about-hero') {
        const aboutImageSource = existingData.image_source || 'upload';
        const hasAboutImage = existingData.image ? true : false;
        html = `
            <label class="form-label">About Hero Banner</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="About Us" value="${existingData.heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Subheading</label>
                <textarea class="form-control" id="data_subheading" rows="2" placeholder="Short tagline">${existingData.subheading || ''}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Banner Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="about_image_source" id="about_image_source_upload" value="upload" ${aboutImageSource === 'upload' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="about_image_source_upload">Upload Image</label>
                    
                    <input type="radio" class="btn-check" name="about_image_source" id="about_image_source_url" value="url" ${aboutImageSource === 'url' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="about_image_source_url">Image URL</label>
                </div>
            </div>
            <div class="mb-2" id="about_image_upload" style="display: ${aboutImageSource === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Banner Image</label>
                <input type="file" class="form-control" id="data_about_image_file" name="about_image_file" accept="image/*">
                ${hasAboutImage ? `<div class="mt-2"><small class="text-muted">Current image: <a href="/${existingData.image?.startsWith('uploads/') ? existingData.image : 'uploads/' + (existingData.image || '')}" target="_blank">View</a></small></div>` : ''}
                <small class="form-text text-muted">Recommended: 1600x600px, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="about_image_url" style="display: ${aboutImageSource === 'url' ? 'block' : 'none'};">
                <label class="form-label">Banner Image URL</label>
                <input type="url" class="form-control" id="data_about_image_url" placeholder="https://example.com/banner.jpg" value="${existingData.image_url || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Minimum Height (px)</label>
                <input type="number" class="form-control" id="data_min_height" placeholder="e.g., 380" value="${existingData.min_height ?? 380}">
            </div>
        `;
    } else if (type === 'home-hero') {
        const homeImageSource = existingData.image_source || 'upload';
        const hasHomeImage = existingData.background_image ? true : false;
        const homeLogoImageSource = existingData.logo_image_source || 'upload';
        const hasLogoImage = existingData.logo_image ? true : false;
        html = `
            <label class="form-label">Home Hero Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Welcome to Our Site" value="${existingData.heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Paragraph</label>
                <textarea class="form-control wysiwyg-editor" id="data_paragraph" rows="3" placeholder="Enter description text">${existingData.paragraph || ''}</textarea>
            </div>
            
            <h6 class="mt-4 mb-2">Logo Image</h6>
            <div class="mb-3">
                <label class="form-label">Logo Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="home_logo_image_source" id="home_logo_image_source_upload" value="upload" ${homeLogoImageSource === 'upload' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="home_logo_image_source_upload">Upload Logo</label>
                    
                    <input type="radio" class="btn-check" name="home_logo_image_source" id="home_logo_image_source_url" value="url" ${homeLogoImageSource === 'url' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="home_logo_image_source_url">Logo URL</label>
                </div>
            </div>
            <div class="mb-2" id="home_logo_image_upload" style="display: ${homeLogoImageSource === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Logo Image</label>
                <input type="file" class="form-control" id="data_home_logo_image_file" name="home_logo_image_file" accept="image/*">
                ${hasLogoImage ? `<div class="mt-2"><small class="text-muted">Current logo: <a href="/${existingData.logo_image?.startsWith('uploads/') ? existingData.logo_image : 'uploads/' + (existingData.logo_image || '')}" target="_blank">View</a></small></div>` : ''}
                <small class="form-text text-muted">Recommended: PNG with transparent background (max 5MB)</small>
            </div>
            <div class="mb-2" id="home_logo_image_url" style="display: ${homeLogoImageSource === 'url' ? 'block' : 'none'};">
                <label class="form-label">Logo Image URL</label>
                <input type="url" class="form-control" id="data_home_logo_image_url" placeholder="https://example.com/logo.png" value="${existingData.logo_image_url || ''}">
            </div>
            
            <h6 class="mt-4 mb-2">Background Image</h6>
            <div class="mb-3">
                <label class="form-label">Background Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="home_background_image_source" id="home_background_image_source_upload" value="upload" ${homeImageSource === 'upload' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="home_background_image_source_upload">Upload Image</label>
                    
                    <input type="radio" class="btn-check" name="home_background_image_source" id="home_background_image_source_url" value="url" ${homeImageSource === 'url' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="home_background_image_source_url">Image URL</label>
                </div>
            </div>
            <div class="mb-2" id="home_background_image_upload" style="display: ${homeImageSource === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Background Image</label>
                <input type="file" class="form-control" id="data_home_background_image_file" name="home_background_image_file" accept="image/*">
                ${hasHomeImage ? `<div class="mt-2"><small class="text-muted">Current image: <a href="/${existingData.background_image?.startsWith('uploads/') ? existingData.background_image : 'uploads/' + (existingData.background_image || '')}" target="_blank">View</a></small></div>` : ''}
                <small class="form-text text-muted">Recommended: 1920x1080px, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="home_background_image_url" style="display: ${homeImageSource === 'url' ? 'block' : 'none'};">
                <label class="form-label">Background Image URL</label>
                <input type="url" class="form-control" id="data_home_background_image_url" placeholder="https://example.com/background.jpg" value="${existingData.background_image_url || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Minimum Height (px)</label>
                <input type="number" class="form-control" id="data_min_height" placeholder="e.g., 500" value="${existingData.min_height ?? 500}">
            </div>
        `;
    } else if (type === 'video-hero') {
        const videoSource = existingData.video_source || 'youtube';
        const hasVideoFile = existingData.video_file ? true : false;
        html = `
            <label class="form-label">Video Hero Data</label>
            <div class="mb-3">
                <label class="form-label">Video Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="video_source" id="video_source_youtube" value="youtube" ${videoSource === 'youtube' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="video_source_youtube">YouTube Link</label>
                    
                    <input type="radio" class="btn-check" name="video_source" id="video_source_mp4" value="mp4" ${videoSource === 'mp4' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="video_source_mp4">MP4 Video Link</label>
                    
                    <input type="radio" class="btn-check" name="video_source" id="video_source_upload" value="upload" ${videoSource === 'upload' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="video_source_upload">Upload Video</label>
                </div>
            </div>
            <div class="mb-2" id="youtube_source" style="display: ${videoSource === 'youtube' ? 'block' : 'none'};">
                <label class="form-label">YouTube Video Link</label>
                <input type="url" class="form-control" id="data_youtube_link" placeholder="https://www.youtube.com/watch?v=..." value="${existingData.youtube_link || ''}">
                <small class="form-text text-muted">Enter full YouTube URL or video ID</small>
            </div>
            <div class="mb-2" id="mp4_source" style="display: ${videoSource === 'mp4' ? 'block' : 'none'};">
                <label class="form-label">MP4 Video Link (CDN/External URL)</label>
                <input type="url" class="form-control" id="data_mp4_link" placeholder="https://cdn.example.com/video.mp4" value="${existingData.mp4_link || ''}">
                <small class="form-text text-muted">Enter direct MP4 video URL (e.g., CDN link). Video will autoplay in background.</small>
            </div>
            <div class="mb-2" id="upload_source" style="display: ${videoSource === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Video File</label>
                <input type="file" class="form-control" id="data_video_file" name="video_file" accept="video/*">
                <small class="form-text text-muted">Supported formats: MP4, WebM, OGG (Max size: 50MB)</small>
                ${hasVideoFile ? `<div class="mt-2"><small class="text-muted">Current video: <a href="/${existingData.video_file?.startsWith('uploads/') ? existingData.video_file : 'uploads/' + (existingData.video_file || '')}" target="_blank">View</a></small></div>` : ''}
                <div id="video_preview" class="mt-2" style="display: none;">
                    <video id="preview_video" width="100%" height="200" controls style="max-width: 500px;"></video>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Main Heading" value="${existingData.heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Short Detail</label>
                <textarea class="form-control wysiwyg-editor" id="data_short_detail" rows="3" placeholder="Short description">${existingData.short_detail || ''}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_btn_text" placeholder="Click Here" value="${existingData.btn_text || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_btn_link" placeholder="https://example.com" value="${existingData.btn_link || ''}">
            </div>
        `;
    } else if (type === 'content') {
        html = `
            <label class="form-label">Content</label>
            <textarea class="form-control wysiwyg-editor" id="data_content" rows="10" placeholder="Enter HTML content">${existingData.content || ''}</textarea>
            <small class="form-text text-muted">You can use HTML tags</small>
        `;
    } else if (type === 'our-services') {
        const selectedServiceIds = existingData.service_ids || [];
        let serviceOptions = '';
        servicesData.forEach(service => {
            const isSelected = selectedServiceIds.includes(service.id) ? 'selected' : '';
            serviceOptions += `<option value="${service.id}" ${isSelected}>${service.title}</option>`;
        });
        html = `
            <label class="form-label">Our Services Data</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Our Services" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., What {{ $siteName }} can do for you." value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Services</label>
                <select class="form-select" id="data_service_ids" multiple onchange="renderServicePageMap()">
                    ${serviceOptions}
                </select>
                <small class="form-text text-muted">Select multiple services. Leave empty to show all active services.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Link each service to a page</label>
                <div id="servicePageMapContainer" class="border rounded p-2 bg-light"></div>
                <small class="form-text text-muted">Optional: choose a page for each service card. If not set, it will try to auto-match by title/slug.</small>
            </div>
        `;
    } else if (type === 'who-we-are') {
        html = `
            <label class="form-label">Who We Are Data</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Who We Are" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., How can {{ $siteName }} help you?" value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="10" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">Rich text editor - you can format text with bold, lists, links, etc.</small>
            </div>
        `;
    } else if (type === 'trusted-partner') {
        const imageSource = existingData.image_source || 'url';
        const hasImage = existingData.image ? true : false;
        html = `
            <label class="form-label">Trusted Partner Data</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., A trusted partner" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., We are NADCA Accredited" value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="5" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="image_source" id="image_source_url" value="url" ${imageSource === 'url' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="image_source_url">Image URL</label>
                    
                    <input type="radio" class="btn-check" name="image_source" id="image_source_upload" value="upload" ${imageSource === 'upload' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="image_source_upload">Upload Image</label>
                </div>
            </div>
            <div class="mb-2" id="image_url_source" style="display: ${imageSource === 'url' ? 'block' : 'none'};">
                <label class="form-label">Image URL</label>
                <input type="url" class="form-control" id="data_image_url" placeholder="https://example.com/image.png" value="${existingData.image_url || ''}">
                <small class="form-text text-muted">Enter direct URL to image (e.g., CDN link)</small>
            </div>
            <div class="mb-2" id="image_upload_source" style="display: ${imageSource === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="data_image_file" name="image_file" accept="image/*">
                <small class="form-text text-muted">Supported formats: JPG, PNG, GIF (Max size: 5MB)</small>
                ${hasImage ? `<div class="mt-2"><small class="text-muted">Current image: <a href="/${existingData.image?.startsWith('uploads/') ? existingData.image : 'uploads/' + (existingData.image || '')}" target="_blank">View</a></small></div>` : ''}
                <div id="image_preview" class="mt-2" style="display: none;">
                    <img id="preview_image" width="100%" height="200" style="max-width: 500px; object-fit: contain;">
                </div>
            </div>
        `;
    } else if (type === 'faq') {
        const faqs = existingData.faqs || [];
        html = `
            <label class="form-label">FAQ Items</label>
            <div id="faqItems">
        `;
        faqs.forEach((faq, index) => {
            html += `
                <div class="faq-item mb-3 p-3 border rounded">
                    <div class="mb-2">
                        <input type="text" class="form-control faq-question" placeholder="Question" value="${faq.question || ''}">
                    </div>
                    <div>
                        <textarea class="form-control wysiwyg-editor faq-answer" rows="2" placeholder="Answer">${faq.answer || ''}</textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq">Remove</button>
                </div>
            `;
        });
        if (faqs.length === 0) {
            html += `
                <div class="faq-item mb-3 p-3 border rounded">
                    <div class="mb-2">
                        <input type="text" class="form-control faq-question" placeholder="Question">
                    </div>
                    <div>
                        <textarea class="form-control wysiwyg-editor faq-answer" rows="2" placeholder="Answer"></textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq">Remove</button>
                </div>
            `;
        }
        html += `</div><button type="button" class="btn btn-sm btn-primary" id="addFaq">Add FAQ Item</button>`;
    } else if (type === 'contact-form') {
        html = `
            <label class="form-label">Contact Form Data</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Request A Quotation" value="${existingData.heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Subheading</label>
                <input type="text" class="form-control" id="data_subheading" placeholder="Fill in the form below and our team will be in touch to discuss your AC Cleaning quote." value="${existingData.subheading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Submit Button Text</label>
                <input type="text" class="form-control" id="data_submit_text" placeholder="Submit Form" value="${existingData.submit_text || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Button Text</label>
                <input type="text" class="form-control" id="data_whatsapp_text" placeholder="WhatsApp Now" value="${existingData.whatsapp_text || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Link</label>
                <input type="url" class="form-control" id="data_whatsapp_url" placeholder="https://wa.me/+971556382341" value="${existingData.whatsapp_url || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Text</label>
                <input type="text" class="form-control" id="data_privacy_text" placeholder="We don’t share your data." value="${existingData.privacy_text || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Link</label>
                <input type="url" class="form-control" id="data_privacy_url" placeholder="/privacy-policy" value="${existingData.privacy_url || ''}">
            </div>
        `;
    } else if (type === 'clients') {
        html = `
            <label class="form-label">Clients Section Data</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Our Corporate Clients" value="${existingData.heading || 'Our Corporate Clients'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Description</label>
                <textarea class="form-control" id="data_description" rows="3" placeholder="Our extensive experience gives us the chance to work with some of the most renowned names in Dubai. Contact our team today for any B2B related enquiries.">${existingData.description || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_button_text" placeholder="Corporate Enquiry" value="${existingData.button_text || 'Corporate Enquiry'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_button_link" placeholder="/contact" value="${existingData.button_link || '/contact'}">
            </div>
            <div class="alert alert-info mt-3">
                <strong>Note:</strong> Client logos are managed separately from the <a href="/admin/client-logos" target="_blank">Client Logos</a> admin page.
            </div>
        `;
    } else if (type === 'about-services-section') {
        const selectedServiceIds = existingData.service_ids || [];
        let serviceOptions = '';
        servicesData.forEach(service => {
            const isSelected = selectedServiceIds.includes(service.id) ? 'selected' : '';
            serviceOptions += `<option value="${service.id}" ${isSelected}>${service.title}</option>`;
        });
        
        const aboutServicesImageSource = existingData.image_source || (existingData.image_url ? 'url' : 'upload');
        const hasAboutServicesImage = existingData.image || existingData.image_url;
        
        html = `
            <label class="form-label">About Services Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="What We Do." value="${existingData.heading || 'What We Do.'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Services</label>
                <select class="form-select" id="data_service_ids" multiple>
                    ${serviceOptions}
                </select>
                <small class="form-text text-muted">Select services to display. Services must have icon_url set. Manage services from <a href="/admin/services" target="_blank">Services</a> admin page.</small>
            </div>
            <div class="mb-2 mt-3">
                <label class="form-label">Background Image</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="about_services_image_source" id="about_services_image_source_upload" value="upload" ${aboutServicesImageSource === 'upload' ? 'checked' : ''} onchange="toggleAboutServicesImageSource()">
                    <label class="btn btn-outline-primary" for="about_services_image_source_upload">Upload Image</label>
                    <input type="radio" class="btn-check" name="about_services_image_source" id="about_services_image_source_url" value="url" ${aboutServicesImageSource === 'url' ? 'checked' : ''} onchange="toggleAboutServicesImageSource()">
                    <label class="btn btn-outline-primary" for="about_services_image_source_url">Image URL</label>
                </div>
            </div>
            <div class="mb-2" id="about_services_image_upload" style="display: ${aboutServicesImageSource === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Background Image</label>
                <input type="file" class="form-control" id="data_about_services_image_file" name="about_services_image_file" accept="image/*">
                ${hasAboutServicesImage && aboutServicesImageSource === 'upload' ? `<div class="mt-2"><small class="text-muted">Current image: <a href="/${existingData.image?.startsWith('uploads/') ? existingData.image : 'uploads/' + (existingData.image || '')}" target="_blank">View</a></small></div>` : ''}
                <small class="form-text text-muted">Recommended: 800x600px, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="about_services_image_url" style="display: ${aboutServicesImageSource === 'url' ? 'block' : 'none'};">
                <label class="form-label">Background Image URL</label>
                <input type="url" class="form-control" id="data_image_url" placeholder="https://example.com/image.jpg" value="${existingData.image_url || ''}">
                <small class="form-text text-muted">Enter direct URL to background image</small>
            </div>
        `;
    } else if (type === 'contact-page-section') {
        html = `
            <label class="form-label">Contact Page Section</label>
            <h6 class="mt-3 mb-2">Hero Section</h6>
            <div class="mb-2">
                <label class="form-label">Hero Heading</label>
                <input type="text" class="form-control" id="data_hero_heading" placeholder="Get in touch" value="${existingData.hero_heading || 'Get in touch'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Hero Description</label>
                <textarea class="form-control" id="data_hero_description" rows="3" placeholder="Want to get in touch with Pro Clean AC? We'd love to hear from you. Here's how you can reach us..">${existingData.hero_description || 'Want to get in touch with Pro Clean AC? We\'d love to hear from you. Here\'s how you can reach us..'}</textarea>
            </div>
            <div class="mb-2 mt-3">
                <label class="form-label">Hero Background Image</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="contact_hero_bg_image_source" id="contact_hero_bg_image_source_upload" value="upload" ${(existingData.hero_bg_image_source || (existingData.hero_bg_image ? 'upload' : 'url')) === 'upload' ? 'checked' : ''} onchange="toggleContactHeroBgImageSource()">
                    <label class="btn btn-outline-primary" for="contact_hero_bg_image_source_upload">Upload Image</label>
                    <input type="radio" class="btn-check" name="contact_hero_bg_image_source" id="contact_hero_bg_image_source_url" value="url" ${(existingData.hero_bg_image_source || 'url') === 'url' ? 'checked' : ''} onchange="toggleContactHeroBgImageSource()">
                    <label class="btn btn-outline-primary" for="contact_hero_bg_image_source_url">Image URL</label>
                </div>
            </div>
            <div class="mb-2" id="contact_hero_bg_image_upload" style="display: ${(existingData.hero_bg_image_source || (existingData.hero_bg_image ? 'upload' : 'url')) === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Background Image</label>
                <input type="file" class="form-control" id="data_contact_hero_bg_image_file" name="contact_hero_bg_image_file" accept="image/*">
                ${existingData.hero_bg_image ? `<div class="mt-2"><small class="text-muted">Current image: <a href="/${existingData.hero_bg_image?.startsWith('uploads/') ? existingData.hero_bg_image : 'uploads/' + (existingData.hero_bg_image || '')}" target="_blank">View</a></small></div>` : ''}
                <small class="form-text text-muted">Recommended: 1920x600px, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="contact_hero_bg_image_url" style="display: ${(existingData.hero_bg_image_source || 'url') === 'url' ? 'block' : 'none'};">
                <label class="form-label">Background Image URL</label>
                <input type="url" class="form-control" id="data_hero_bg_image_url" placeholder="https://example.com/image.jpg" value="${existingData.hero_bg_image_url || ''}">
                <small class="form-text text-muted">Enter direct URL to background image</small>
            </div>
            <h6 class="mt-3 mb-2">Contact Option 1 - Leave a Message</h6>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_message_heading" placeholder="Leave us a Message" value="${existingData.message_heading || 'Leave us a Message'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Description</label>
                <textarea class="form-control" id="data_message_description" rows="2" placeholder="Interested in Pro Clean AC? Just leave us a message and our team will get back to you as quickly as possible..">${existingData.message_description || 'Interested in Pro Clean AC? Just leave us a message and our team will get back to you as quickly as possible..'}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Online Form Button Text</label>
                <input type="text" class="form-control" id="data_online_form_text" placeholder="Online Form" value="${existingData.online_form_text || 'Online Form'}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Button Text</label>
                <input type="text" class="form-control" id="data_message_whatsapp_text" placeholder="WhatsApp" value="${existingData.message_whatsapp_text || 'WhatsApp'}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp URL</label>
                <input type="url" class="form-control" id="data_message_whatsapp_url" placeholder="https://wa.me/971556382341?text=Hi!%20I'd%20like%20to%20know%20more%20about%20your%20AC%20cleaning%20service." value="${existingData.message_whatsapp_url || 'https://wa.me/971556382341?text=Hi!%20I\'d%20like%20to%20know%20more%20about%20your%20AC%20cleaning%20service.'}">
            </div>
            <h6 class="mt-3 mb-2">Contact Option 2 - Give us a Call</h6>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_call_heading" placeholder="Give us a Call" value="${existingData.call_heading || 'Give us a Call'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Description</label>
                <textarea class="form-control" id="data_call_description" rows="2" placeholder="Want to speak directly with Pro Clean AC? Just pick up the phone to chat with our team directly..">${existingData.call_description || 'Want to speak directly with Pro Clean AC? Just pick up the phone to chat with our team directly..'}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Phone Number 1</label>
                <input type="tel" class="form-control" id="data_phone_1" placeholder="+971 55 638 2341" value="${existingData.phone_1 || '+971 55 638 2341'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Phone Number 2</label>
                <input type="tel" class="form-control" id="data_phone_2" placeholder="+971 4 372 1198" value="${existingData.phone_2 || '+971 4 372 1198'}">
            </div>
            <h6 class="mt-3 mb-2">Contact Form Section</h6>
            <div class="mb-2">
                <label class="form-label">Form Heading</label>
                <input type="text" class="form-control" id="data_form_heading" placeholder="Request A Quotation" value="${existingData.form_heading || 'Request A Quotation'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Form Subheading</label>
                <textarea class="form-control" id="data_form_subheading" rows="2" placeholder="Fill in the form below and our team will be in touch to discuss your AC Cleaning quote.">${existingData.form_subheading || 'Fill in the form below and our team will be in touch to discuss your AC Cleaning quote.'}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Submit Button Text</label>
                <input type="text" class="form-control" id="data_submit_text" placeholder="Submit Form" value="${existingData.submit_text || 'Submit Form'}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Button Text</label>
                <input type="text" class="form-control" id="data_form_whatsapp_text" placeholder="WhatsApp Now" value="${existingData.form_whatsapp_text || 'WhatsApp Now'}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp URL</label>
                <input type="url" class="form-control" id="data_form_whatsapp_url" placeholder="https://wa.me/+971556382341" value="${existingData.form_whatsapp_url || 'https://wa.me/+971556382341'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Text</label>
                <input type="text" class="form-control" id="data_privacy_text" placeholder="We don't share your data." value="${existingData.privacy_text || 'We don\'t share your data.'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Policy URL</label>
                <input type="url" class="form-control" id="data_privacy_url" placeholder="/privacy-policy" value="${existingData.privacy_url || '/privacy-policy'}">
            </div>
            <h6 class="mt-3 mb-2">Map & Office Details Section</h6>
            <div class="mb-2">
                <label class="form-label">Section Heading</label>
                <input type="text" class="form-control" id="data_map_heading" placeholder="How to find us" value="${existingData.map_heading || 'How to find us'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Office Name</label>
                <input type="text" class="form-control" id="data_office_name" placeholder="Pro Clean AC - Dubai Office" value="${existingData.office_name || 'Pro Clean AC - Dubai Office'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Office Address</label>
                <textarea class="form-control" id="data_office_address" rows="3" placeholder="9th Floor, The H Office, 1 Sheikh Zayed Road, Dubai">${existingData.office_address || '9th Floor, The H Office, 1 Sheikh Zayed Road, Dubai'}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Office Phone 1</label>
                <input type="tel" class="form-control" id="data_office_phone_1" placeholder="+971 556 382 341" value="${existingData.office_phone_1 || '+971 556 382 341'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Office Phone 2</label>
                <input type="tel" class="form-control" id="data_office_phone_2" placeholder="+971 4 372 1198" value="${existingData.office_phone_2 || '+971 4 372 1198'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Office Email</label>
                <input type="email" class="form-control" id="data_office_email" placeholder="info@proclean-ac.com" value="${existingData.office_email || 'info@proclean-ac.com'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Google Maps Embed URL</label>
                <textarea class="form-control" id="data_map_embed_url" rows="3" placeholder="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14436.790969835114!2d55.2871273!3d25.2302639!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe9d5cd9fef15ef8b!2sPro%20Clean%20AC!5e0!3m2!1sen!2sua!4v1624280448647!5m2!1sen!2sua">${existingData.map_embed_url || ''}</textarea>
                <small class="form-text text-muted">Paste the full iframe src URL from Google Maps embed code</small>
            </div>
        `;
    } else if (type === 'about-ct-section') {
        html = `
            <label class="form-label">About CT Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Interested in booking a visit with Pro Clean AC?" value="${existingData.heading || 'Interested in booking a visit with Pro Clean AC?'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_button_text" placeholder="Plan A Visit" value="${existingData.button_text || 'Plan A Visit'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_button_link" placeholder="/contact" value="${existingData.button_link || '/contact'}">
            </div>
        `;
    } else if (type === 'what-we-do') {
        const items = existingData.items || [];
        html = `
            <label class="form-label">What We Do</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="What We Do." value="${existingData.heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Items</label>
                <div id="whatWeDoItems">
                    ${
                        items.length
                            ? items.map((item, idx) => `
                                <div class="what-item mb-3 p-3 border rounded">
                                    <div class="mb-2">
                                        <label class="form-label">Icon URL</label>
                                        <input type="url" class="form-control what-icon" placeholder="https://..." value="${item.icon || ''}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control what-title" placeholder="Title" value="${item.title || ''}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control wysiwyg-editor what-desc" rows="2" placeholder="Description">${item.description || ''}</textarea>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-what">Remove</button>
                                </div>
                            `).join('')
                            : `
                                <div class="what-item mb-3 p-3 border rounded">
                                    <div class="mb-2">
                                        <label class="form-label">Icon URL</label>
                                        <input type="url" class="form-control what-icon" placeholder="https://...">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control what-title" placeholder="Title">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control wysiwyg-editor what-desc" rows="2" placeholder="Description"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-what">Remove</button>
                                </div>
                            `
                    }
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="addWhat">Add Item</button>
            </div>
        `;
    } else if (type === 'pro-clean') {
        html = `
            <label class="form-label">Pro Clean Tabs</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="Why {{ $siteName }}?" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="What makes us different?" value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Tabs</label>
                <div id="proCleanTabs"></div>
                <button type="button" class="btn btn-sm btn-primary mt-2" id="addProTab">Add Tab</button>
                <small class="form-text text-muted">Supports HTML in content for links.</small>
            </div>
        `;
    } else if (type === 'plan-visit') {
        html = `
            <label class="form-label">Plan A Visit</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Interested in booking a visit with {{ $siteName }}?" value="${existingData.heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_btn_text" placeholder="Plan A Visit" value="${existingData.btn_text || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_btn_link" placeholder="/contact" value="${existingData.btn_link || '/contact'}">
            </div>
        `;
    } else if (type === 'free-quotation') {
        html = `
            <label class="form-label">Free Quotation</label>
            <div class="mb-2">
                <label class="form-label">Heading (Text Before Link)</label>
                <input type="text" class="form-control" id="data_heading_before" placeholder="Get a" value="${existingData.heading_before || 'Get a'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Link Text</label>
                <input type="text" class="form-control" id="data_link_text" placeholder="free quotation" value="${existingData.link_text || 'free quotation'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Link URL</label>
                <input type="url" class="form-control" id="data_link_url" placeholder="/contact" value="${existingData.link_url || '/contact'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Heading (Text After Link)</label>
                <input type="text" class="form-control" id="data_heading_after" placeholder="today!" value="${existingData.heading_after || 'today!'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Description</label>
                <textarea class="form-control" id="data_description" rows="3" placeholder="Click below to plan a visit with the {{ $siteName }} team. Our team of experts will help guide, advise and execute any AC cleaning related work that you need.">${existingData.description || 'Click below to plan a visit with the {{ $siteName }} team. Our team of experts will help guide, advise and execute any AC cleaning related work that you need.'}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_btn_text" placeholder="Free Quotation" value="${existingData.btn_text || 'Free Quotation'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_btn_link" placeholder="/contact" value="${existingData.btn_link || '/contact'}">
            </div>
        `;
    } else if (type === 'about-top-content') {
        html = `
            <label class="form-label">About Top Content</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="About Us" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="Cleaner air for you and your family." value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="8" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'about-2nd-section') {
        html = `
            <label class="form-label">About 2nd Section</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="About Us" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="Cleaner air for you and your family." value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="8" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'service-4th-blue-section') {
        html = `
            <label class="form-label">Service 4th Blue Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="e.g., Maintaining Good Air Quality" value="${existingData.heading || ''}">
                <small class="form-text text-muted">You can use &lt;strong&gt; tags for bold text. Example: &lt;strong&gt;Maintaining Good Air Quality&lt;/strong&gt;</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Left Column Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_left_content" rows="8" placeholder="Enter left column content...">${existingData.left_content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Right Column Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_right_content" rows="8" placeholder="Enter right column content...">${existingData.right_content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'service-4th-section') {
        html = `
            <label class="form-label">Service 4th Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="e.g., Save money on your bills." value="${existingData.heading || ''}">
                <small class="form-text text-muted">You can use &lt;strong&gt; tags for bold text. Example: &lt;strong&gt;Save money on your bills.&lt;/strong&gt;</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="6" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_button_text" placeholder="Contact Now" value="${existingData.button_text || 'Contact Now'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_button_link" placeholder="/contact" value="${existingData.button_link || '/contact'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Link Text</label>
                <input type="text" class="form-control" id="data_link_text" placeholder="Plan A Visit" value="${existingData.link_text || 'Plan A Visit'}">
                <small class="form-text text-muted">Text for the link next to button</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Link URL</label>
                <input type="url" class="form-control" id="data_link_url" placeholder="/contact" value="${existingData.link_url || '/contact'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Image URL</label>
                <input type="url" class="form-control" id="data_image_url" placeholder="https://..." value="${existingData.image_url || ''}">
                <small class="form-text text-muted">Right side image URL</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Image Alt Text</label>
                <input type="text" class="form-control" id="data_image_alt" placeholder="AC duct cleaning" value="${existingData.image_alt || 'AC duct cleaning'}">
            </div>
        `;
    } else if (type === 'service-top-section') {
        html = `
            <label class="form-label">Service Top Section</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Duct Cleaning" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., Pro Clean AC are Dubai's Experts in Duct Cleaning." value="${existingData.main_heading || ''}">
                <small class="form-text text-muted">You can use &nbsp; for non-breaking spaces.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="10" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'service-below-2nd-section') {
        html = `
            <label class="form-label">Service Below 2nd Section</label>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="12" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security. Use &lt;strong&gt; tags for bold text.</small>
            </div>
        `;
    } else if (type === 'service-form-section') {
        html = `
            <label class="form-label">Service Form Section</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Request A Quotation" value="${existingData.short_heading || 'Request A Quotation'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <textarea class="form-control wysiwyg-editor" id="data_main_heading" rows="2" placeholder="e.g., Fill in the form below and our team will be in touch to discuss your quote.">${existingData.main_heading || 'Fill in the form below and our team will be in touch to discuss your quote.'}</textarea>
                <small class="form-text text-muted">You can use &nbsp; for non-breaking spaces.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Submit Button Text</label>
                <input type="text" class="form-control" id="data_submit_text" placeholder="Submit Form" value="${existingData.submit_text || 'Submit Form'}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Button Text</label>
                <input type="text" class="form-control" id="data_whatsapp_text" placeholder="WhatsApp Now" value="${existingData.whatsapp_text || 'WhatsApp Now'}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp URL</label>
                <input type="url" class="form-control" id="data_whatsapp_url" placeholder="https://wa.me/+971556382341" value="${existingData.whatsapp_url || 'https://wa.me/+971556382341'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Text</label>
                <input type="text" class="form-control" id="data_privacy_text" placeholder="We don't share your data." value="${existingData.privacy_text || 'We dont share your data.'}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Policy URL</label>
                <input type="url" class="form-control" id="data_privacy_url" placeholder="/privacy-policy" value="${existingData.privacy_url || '/privacy-policy'}">
            </div>
        `;
    } else if (type === 'service-3rd-section') {
        const imageSource = existingData.image_source || 'upload';
        const imageUrl = existingData.image_url || '';
        const hasUploadedImage = existingData.image && existingData.image_source === 'upload';
        
        html = `
            <label class="form-label">Service 3rd Section</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Dubai's experts in AC Cleaning" value="${existingData.short_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., When to clean your AC ducts?" value="${existingData.main_heading || ''}">
                <small class="form-text text-muted">You can use &nbsp; for non-breaking spaces.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="10" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="service_3rd_image_source" id="service_3rd_image_source_upload" value="upload" ${imageSource === 'upload' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="service_3rd_image_source_upload">Upload Image</label>
                    
                    <input type="radio" class="btn-check" name="service_3rd_image_source" id="service_3rd_image_source_url" value="url" ${imageSource === 'url' ? 'checked' : ''}>
                    <label class="btn btn-outline-primary" for="service_3rd_image_source_url">Image URL</label>
                </div>
            </div>
            ${hasUploadedImage ? `
            <div class="mb-2">
                <label class="form-label">Current Image</label>
                <div>
                    <img src="/${existingData.image}" alt="Current image" style="max-height: 200px; border-radius: 4px;">
                </div>
            </div>
            ` : ''}
            <div class="mb-2" id="service_3rd_image_upload" style="display: ${imageSource === 'upload' ? 'block' : 'none'};">
                <label class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="data_service_3rd_image_file" name="service_3rd_image_file" accept="image/*">
                <small class="form-text text-muted">Recommended: 612px width, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="service_3rd_image_url" style="display: ${imageSource === 'url' ? 'block' : 'none'};">
                <label class="form-label">Image URL</label>
                <input type="url" class="form-control" id="data_service_3rd_image_url" placeholder="https://example.com/image.jpg" value="${imageUrl}">
            </div>
            <div class="mb-2">
                <label class="form-label">Image Alt Text</label>
                <input type="text" class="form-control" id="data_image_alt" placeholder="e.g., Duct cleaning Dubai" value="${existingData.image_alt || ''}">
            </div>
        `;
    } else if (NewDesignAdmin.isType(type)) {
        html = NewDesignAdmin.renderFields(type, newDesignFormData(type));
    } else if (IrhasAdmin.isType(type)) {
        html = IrhasAdmin.renderFields(type, irhasFormData(type));
    } else if (type === 'new-full') {
        html = `
            <label class="form-label">New Full Section</label>
            <div class="mb-2">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" id="data_title" placeholder="Enter title" value="${existingData.title || ''}">
            </div>
        `;
    }
    
    dataFields.innerHTML = html;
    setTimeout(initWysiwygEditors, 350);

    if (NewDesignAdmin.isType(type)) {
        setTimeout(() => NewDesignAdmin.initFields(type, newDesignFormData(type)), 60);
    }
    if (IrhasAdmin.isType(type)) {
        setTimeout(() => IrhasAdmin.initFields(type, irhasFormData(type)), 60);
    }
    
    if (type === 'about-hero') {
        setTimeout(function() {
            const aboutImageRadios = document.querySelectorAll('input[name="about_image_source"]');
            const uploadWrap = document.getElementById('about_image_upload');
            const urlWrap = document.getElementById('about_image_url');
            
            if (aboutImageRadios.length > 0) {
                aboutImageRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'upload') {
                            uploadWrap.style.display = 'block';
                            urlWrap.style.display = 'none';
                        } else {
                            uploadWrap.style.display = 'none';
                            urlWrap.style.display = 'block';
                        }
                    });
                });
            }
        }, 50);
    }
    
    // Handle image source toggles for home-hero
    if (type === 'home-hero') {
        setTimeout(function() {
            // Background image source toggle
            const homeImageRadios = document.querySelectorAll('input[name="home_background_image_source"]');
            const homeUploadWrap = document.getElementById('home_background_image_upload');
            const homeUrlWrap = document.getElementById('home_background_image_url');
            
            if (homeImageRadios.length > 0) {
                homeImageRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'upload') {
                            homeUploadWrap.style.display = 'block';
                            homeUrlWrap.style.display = 'none';
                        } else {
                            homeUploadWrap.style.display = 'none';
                            homeUrlWrap.style.display = 'block';
                        }
                    });
                });
            }
            
            // Logo image source toggle
            const homeLogoRadios = document.querySelectorAll('input[name="home_logo_image_source"]');
            const homeLogoUploadWrap = document.getElementById('home_logo_image_upload');
            const homeLogoUrlWrap = document.getElementById('home_logo_image_url');
            
            if (homeLogoRadios.length > 0) {
                homeLogoRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'upload') {
                            homeLogoUploadWrap.style.display = 'block';
                            homeLogoUrlWrap.style.display = 'none';
                        } else {
                            homeLogoUploadWrap.style.display = 'none';
                            homeLogoUrlWrap.style.display = 'block';
                        }
                    });
                });
            }
        }, 50);
    }
    
    // Handle image source toggle for service-3rd-section
    if (type === 'service-3rd-section') {
        setTimeout(function() {
            const service3rdImageRadios = document.querySelectorAll('input[name="service_3rd_image_source"]');
            const service3rdUploadWrap = document.getElementById('service_3rd_image_upload');
            const service3rdUrlWrap = document.getElementById('service_3rd_image_url');
            
            if (service3rdImageRadios.length > 0) {
                service3rdImageRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'upload') {
                            service3rdUploadWrap.style.display = 'block';
                            service3rdUrlWrap.style.display = 'none';
                        } else {
                            service3rdUploadWrap.style.display = 'none';
                            service3rdUrlWrap.style.display = 'block';
                        }
                    });
                });
            }
        }, 50);
    }
    
    // Handle image source toggle for trusted-partner
    if (type === 'trusted-partner') {
        setTimeout(function() {
            const imageSourceRadios = document.querySelectorAll('input[name="image_source"]');
            const imageUrlDiv = document.getElementById('image_url_source');
            const imageUploadDiv = document.getElementById('image_upload_source');
            const imageFileInput = document.getElementById('data_image_file');
            
            if (imageSourceRadios.length > 0) {
                imageSourceRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'url') {
                            imageUrlDiv.style.display = 'block';
                            imageUploadDiv.style.display = 'none';
                        } else {
                            imageUrlDiv.style.display = 'none';
                            imageUploadDiv.style.display = 'block';
                        }
                    });
                });
            }
            
            // Image preview for upload
            if (imageFileInput) {
                imageFileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById('image_preview');
                            const previewImg = document.getElementById('preview_image');
                            if (preview && previewImg) {
                                previewImg.src = e.target.result;
                                preview.style.display = 'block';
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        }, 100);
    }
    
    // Handle video source toggle for video-hero
    if (type === 'video-hero') {
        const youtubeRadio = document.getElementById('video_source_youtube');
        const mp4Radio = document.getElementById('video_source_mp4');
        const uploadRadio = document.getElementById('video_source_upload');
        const youtubeSource = document.getElementById('youtube_source');
        const mp4Source = document.getElementById('mp4_source');
        const uploadSource = document.getElementById('upload_source');
        const videoFileInput = document.getElementById('data_video_file');
        const videoPreview = document.getElementById('video_preview');
        const previewVideo = document.getElementById('preview_video');
        
        function toggleVideoSource() {
            if (youtubeRadio && youtubeRadio.checked) {
                youtubeSource.style.display = 'block';
                mp4Source.style.display = 'none';
                uploadSource.style.display = 'none';
                if (videoFileInput) videoFileInput.removeAttribute('required');
                const youtubeInput = document.getElementById('data_youtube_link');
                if (youtubeInput) youtubeInput.setAttribute('required', 'required');
                const mp4Input = document.getElementById('data_mp4_link');
                if (mp4Input) mp4Input.removeAttribute('required');
            } else if (mp4Radio && mp4Radio.checked) {
                youtubeSource.style.display = 'none';
                mp4Source.style.display = 'block';
                uploadSource.style.display = 'none';
                if (videoFileInput) videoFileInput.removeAttribute('required');
                const youtubeInput = document.getElementById('data_youtube_link');
                if (youtubeInput) youtubeInput.removeAttribute('required');
                const mp4Input = document.getElementById('data_mp4_link');
                if (mp4Input) mp4Input.setAttribute('required', 'required');
            } else if (uploadRadio && uploadRadio.checked) {
                youtubeSource.style.display = 'none';
                mp4Source.style.display = 'none';
                uploadSource.style.display = 'block';
                const youtubeInput = document.getElementById('data_youtube_link');
                if (youtubeInput) youtubeInput.removeAttribute('required');
                const mp4Input = document.getElementById('data_mp4_link');
                if (mp4Input) mp4Input.removeAttribute('required');
                if (videoFileInput) videoFileInput.setAttribute('required', 'required');
            }
        }
        
        if (youtubeRadio) youtubeRadio.addEventListener('change', toggleVideoSource);
        if (mp4Radio) mp4Radio.addEventListener('change', toggleVideoSource);
        if (uploadRadio) uploadRadio.addEventListener('change', toggleVideoSource);
        
        // Preview uploaded video
        if (videoFileInput) {
            videoFileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file && previewVideo) {
                    const url = URL.createObjectURL(file);
                    previewVideo.src = url;
                    videoPreview.style.display = 'block';
                } else if (videoPreview) {
                    videoPreview.style.display = 'none';
                }
            });
        }
    }
    
    if (type === 'faq') {
        document.getElementById('addFaq').addEventListener('click', function() {
            const faqItems = document.getElementById('faqItems');
            const newItem = document.createElement('div');
            newItem.className = 'faq-item mb-3 p-3 border rounded';
            newItem.innerHTML = `
                <div class="mb-2">
                    <input type="text" class="form-control faq-question" placeholder="Question">
                </div>
                <div>
                    <textarea class="form-control wysiwyg-editor faq-answer" rows="2" placeholder="Answer"></textarea>
                </div>
                <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq">Remove</button>
            `;
            faqItems.appendChild(newItem);
            
            newItem.querySelector('.remove-faq').addEventListener('click', function() {
                newItem.remove();
            });
        });
        
        document.querySelectorAll('.remove-faq').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.faq-item').remove();
            });
        });
    }

    if (type === 'what-we-do') {
        const addBtn = document.getElementById('addWhat');
        const container = document.getElementById('whatWeDoItems');
        if (addBtn && container) {
            addBtn.addEventListener('click', function() {
                const item = document.createElement('div');
                item.className = 'what-item mb-3 p-3 border rounded';
                item.innerHTML = `
                    <div class="mb-2">
                        <label class="form-label">Icon URL</label>
                        <input type="url" class="form-control what-icon" placeholder="https://...">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control what-title" placeholder="Title">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea class="form-control wysiwyg-editor what-desc" rows="2" placeholder="Description"></textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-what">Remove</button>
                `;
                container.appendChild(item);
                item.querySelector('.remove-what').addEventListener('click', function() {
                    item.remove();
                });
            });
        }
        container?.querySelectorAll('.remove-what').forEach(btn => {
            btn.addEventListener('click', function() {
                btn.closest('.what-item')?.remove();
            });
        });
    }

    if (type === 'pro-clean') {
        const defaultTabs = [
            {
                tab_label: 'Brand Values',
                title: 'Brand Values',
                content: 'We take a lot of pride in our name and level of service that we offer you and your family. It starts with a quick response back to all enquiries and upon booking an appointment, we arrive on time, as promised. Our team are also easily identifiable in our branded uniforms and vehicles. Cleanliness is our top priority when we enter your homes or place of business, as well as communication between the team and the customer.',
                image: 'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/65b34f216d5ad2b2bf833d4f_Square%20Photo%20-%20About%20Us%20(1).jpg',
                image_alt: 'Brand values image'
            },
            {
                tab_label: 'Approach',
                title: 'Approach',
                content: siteName + '\'s approach is very positive, friendly, and professional approach. We pride ourselves in achieving our 5* reviews on a daily basis. Check out <a href="https://www.google.com/search?rlz=1C5CHFA_enAE899AE899&sxsrf=ALeKk02mzxxJjJ81A_Lx0OVpcAH86gjLbg%3A1612282921190&ei=KXwZYM6UC-iP1fAPxN-LiAM&q=pro+clean+ac+google+reviews&oq=pro+clean+ac+google+reviews&gs_lcp=CgZwc3ktYWIQAzIFCCEQoAE6BwgjELADECc6BwgAEEcQsAM6BAgjECc6DQguEMcBEK8BEBQQhwI6AggAOgYIABAWEB46BwghEAoQoAFQ8DtY01BgkFFoA3ACeACAAfYBiAGyGZIBBjAuMTEuNZgBAKABAaoBB2d3cy13aXrIAQfAAQE&sclient=psy-ab&ved=0ahUKEwiOza32zcvuAhXoRxUIHcTvAjEQ4dUDCA0&uact=5#lrd=0x3e5f4338e6cb9bf3:0xe9d5cd9fef15ef8b,1,,," class="link-4">our reviews</a>.',
                image: 'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/60cb30d7fdf562c2b808f1f8_Pro%20Clean%20AC%20Background-min-min.jpg',
                image_alt: siteName + ' background image'
            }
        ];
        const container = document.getElementById('proCleanTabs');
        const addBtn = document.getElementById('addProTab');
        const initialTabs = (existingData.tabs && existingData.tabs.length) ? existingData.tabs : defaultTabs;
        const tabs = initialTabs.map(tab => ({ ...tab }));

        const renderTabs = (list) => {
            if (!container) return;
            container.innerHTML = '';
            list.forEach((tab, index) => {
                const item = document.createElement('div');
                item.className = 'pro-tab-item mb-3 p-3 border rounded';
                item.innerHTML = `
                    <div class="mb-2">
                        <label class="form-label">Tab Label</label>
                        <input type="text" class="form-control pro-tab-label" placeholder="Brand Values" value="${tab.tab_label || ''}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Tab Title</label>
                        <input type="text" class="form-control pro-tab-title" placeholder="Brand Values" value="${tab.title || ''}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Content (supports HTML)</label>
                        <textarea class="form-control wysiwyg-editor pro-tab-content" rows="4" placeholder="Tab content...">${tab.content || ''}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Image URL or Upload Path</label>
                        <input type="text" class="form-control pro-tab-image" placeholder="https://..." value="${tab.image || ''}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Image Alt</label>
                        <input type="text" class="form-control pro-tab-alt" placeholder="Image description" value="${tab.image_alt || ''}">
                    </div>
                    ${list.length > 1 ? '<button type="button" class="btn btn-sm btn-danger remove-pro-tab">Remove</button>' : ''}
                `;
                container.appendChild(item);

                const removeBtn = item.querySelector('.remove-pro-tab');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        list.splice(index, 1);
                        renderTabs(list);
                    });
                }
            });
        };

        if (container) {
            renderTabs(tabs);

            addBtn?.addEventListener('click', function() {
                tabs.push({ tab_label: '', title: '', content: '', image: '', image_alt: '' });
                renderTabs(tabs);
            });
        }
    }

    if (type === 'our-services') {
        setTimeout(function() {
            // Initialize Select2
            if ($('#data_service_ids').length && !$('#data_service_ids').hasClass('select2-hidden-accessible')) {
                $('#data_service_ids').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Select services...',
                    allowClear: true,
                    width: '100%'
                });
            }
            renderServicePageMap();
        }, 50);
    }
}

document.getElementById('sectionForm').addEventListener('submit', function(e) {
    syncWysiwygEditors();
    
    const type = document.getElementById('type').value;
    const data = {};
    
    if (type === 'hero') {
        data.title = document.getElementById('data_title')?.value || '';
        data.subtitle = document.getElementById('data_subtitle')?.value || '';
    } else if (type === 'about-hero') {
        const imageSource = document.querySelector('input[name="about_image_source"]:checked')?.value || 'upload';
        data.image_source = imageSource;
        data.heading = document.getElementById('data_heading')?.value || '';
        data.subheading = document.getElementById('data_subheading')?.value || '';
        data.min_height = parseInt(document.getElementById('data_min_height')?.value, 10) || 0;
        
        if (imageSource === 'url') {
            data.image_url = document.getElementById('data_about_image_url')?.value || '';
            if (existingData.image) {
                data.image = existingData.image;
            }
        } else {
            data.image_url = null;
            const aboutImageFile = document.getElementById('data_about_image_file')?.files[0];
            if (!aboutImageFile && existingData.image) {
                data.image = existingData.image;
            }
        }
    } else if (type === 'home-hero') {
        const imageSource = document.querySelector('input[name="home_background_image_source"]:checked')?.value || 'upload';
        const logoImageSource = document.querySelector('input[name="home_logo_image_source"]:checked')?.value || 'upload';
        
        data.image_source = imageSource;
        data.logo_image_source = logoImageSource;
        data.heading = document.getElementById('data_heading')?.value || '';
        data.paragraph = document.getElementById('data_paragraph')?.value || '';
        data.min_height = parseInt(document.getElementById('data_min_height')?.value, 10) || 500;
        
        // Handle background image
        if (imageSource === 'url') {
            data.background_image_url = document.getElementById('data_home_background_image_url')?.value || '';
            if (existingData.background_image) {
                data.background_image = existingData.background_image;
            }
        } else {
            data.background_image_url = null;
            const backgroundImageFile = document.getElementById('data_home_background_image_file')?.files[0];
            if (!backgroundImageFile && existingData.background_image) {
                data.background_image = existingData.background_image;
            }
        }
        
        // Handle logo image
        if (logoImageSource === 'url') {
            data.logo_image_url = document.getElementById('data_home_logo_image_url')?.value || '';
            if (existingData.logo_image) {
                data.logo_image = existingData.logo_image;
            }
        } else {
            data.logo_image_url = null;
            const logoImageFile = document.getElementById('data_home_logo_image_file')?.files[0];
            if (!logoImageFile && existingData.logo_image) {
                data.logo_image = existingData.logo_image;
            }
        }
    } else if (type === 'video-hero') {
        const videoSource = document.querySelector('input[name="video_source"]:checked')?.value || 'youtube';
        data.video_source = videoSource;
        
        if (videoSource === 'youtube') {
            data.youtube_link = document.getElementById('data_youtube_link')?.value || '';
            data.mp4_link = null;
            // Keep existing video file if switching from upload to youtube
            if (existingData.video_file) {
                data.video_file = existingData.video_file;
            }
        } else if (videoSource === 'mp4') {
            data.mp4_link = document.getElementById('data_mp4_link')?.value || '';
            data.youtube_link = null;
            // Keep existing video file if switching from upload to mp4
            if (existingData.video_file) {
                data.video_file = existingData.video_file;
            }
        } else {
            data.youtube_link = null;
            data.mp4_link = null;
            // Video file will be uploaded separately
            const videoFile = document.getElementById('data_video_file')?.files[0];
            if (videoFile) {
                // File is already in form, will be sent automatically
            } else if (existingData.video_file) {
                // Keep existing video file if not uploading new one
                data.video_file = existingData.video_file;
            }
        }
        
        data.heading = document.getElementById('data_heading')?.value || '';
        data.short_detail = document.getElementById('data_short_detail')?.value || '';
        data.btn_text = document.getElementById('data_btn_text')?.value || '';
        data.btn_link = document.getElementById('data_btn_link')?.value || '';
    } else if (type === 'content') {
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'our-services') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        const serviceSelect = document.getElementById('data_service_ids');
        data.service_ids = Array.from(serviceSelect.selectedOptions).map(option => parseInt(option.value));
        const map = {};
        document.querySelectorAll('.service-page-map-select').forEach(select => {
            const sid = select.dataset.serviceId;
            const pid = select.value;
            if (sid) {
                map[sid] = pid ? parseInt(pid) : null;
            }
        });
        data.service_page_map = map;
    } else if (type === 'who-we-are') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'trusted-partner') {
        const imageSource = document.querySelector('input[name="image_source"]:checked')?.value || 'url';
        data.image_source = imageSource;
        
        if (imageSource === 'url') {
            data.image_url = document.getElementById('data_image_url')?.value || '';
            // Keep existing image if switching from upload to url
            if (existingData.image) {
                data.image = existingData.image;
            }
        } else {
            data.image_url = null;
            // Image file will be uploaded separately
            const imageFile = document.getElementById('data_image_file')?.files[0];
            if (imageFile) {
                // File is already in form, will be sent automatically
            } else if (existingData.image) {
                // Keep existing image file if not uploading new one
                data.image = existingData.image;
            }
        }
        
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'faq') {
        const faqs = [];
        document.querySelectorAll('.faq-item').forEach(item => {
            const question = item.querySelector('.faq-question')?.value;
            const answer = item.querySelector('.faq-answer')?.value;
            if (question && answer) {
                faqs.push({ question, answer });
            }
        });
        data.faqs = faqs;
    } else if (type === 'contact-form') {
        data.heading = document.getElementById('data_heading')?.value || '';
        data.subheading = document.getElementById('data_subheading')?.value || '';
        data.submit_text = document.getElementById('data_submit_text')?.value || '';
        data.whatsapp_text = document.getElementById('data_whatsapp_text')?.value || '';
        data.whatsapp_url = document.getElementById('data_whatsapp_url')?.value || '';
        data.privacy_text = document.getElementById('data_privacy_text')?.value || '';
        data.privacy_url = document.getElementById('data_privacy_url')?.value || '';
    } else if (type === 'clients') {
        data.heading = document.getElementById('data_heading')?.value || 'Our Corporate Clients';
        data.description = document.getElementById('data_description')?.value || '';
        data.button_text = document.getElementById('data_button_text')?.value || 'Corporate Enquiry';
        data.button_link = document.getElementById('data_button_link')?.value || '/contact';
    } else if (type === 'about-services-section') {
        data.heading = document.getElementById('data_heading')?.value || 'What We Do.';
        const serviceSelect = document.getElementById('data_service_ids');
        data.service_ids = Array.from(serviceSelect.selectedOptions).map(option => parseInt(option.value));
        
        const imageSource = document.querySelector('input[name="about_services_image_source"]:checked')?.value || 'upload';
        data.image_source = imageSource;
        
        if (imageSource === 'url') {
            data.image_url = document.getElementById('data_image_url')?.value || null;
            data.image = null;
        } else {
            data.image_url = null;
            const aboutServicesImageFile = document.getElementById('data_about_services_image_file')?.files[0];
            if (!aboutServicesImageFile && existingData.image) {
                data.image = existingData.image;
            }
        }
    } else if (type === 'contact-page-section') {
        // Hero Section
        data.hero_heading = document.getElementById('data_hero_heading')?.value || 'Get in touch';
        data.hero_description = document.getElementById('data_hero_description')?.value || '';
        
        // Hero Background Image
        const heroBgImageSource = document.querySelector('input[name="contact_hero_bg_image_source"]:checked')?.value || 'url';
        data.hero_bg_image_source = heroBgImageSource;
        
        if (heroBgImageSource === 'url') {
            data.hero_bg_image_url = document.getElementById('data_hero_bg_image_url')?.value || null;
            data.hero_bg_image = null;
        } else {
            data.hero_bg_image_url = null;
            const contactHeroBgImageFile = document.getElementById('data_contact_hero_bg_image_file')?.files[0];
            if (!contactHeroBgImageFile && existingData.hero_bg_image) {
                data.hero_bg_image = existingData.hero_bg_image;
            }
        }
        
        // Contact Option 1 - Message
        data.message_heading = document.getElementById('data_message_heading')?.value || 'Leave us a Message';
        data.message_description = document.getElementById('data_message_description')?.value || '';
        data.online_form_text = document.getElementById('data_online_form_text')?.value || 'Online Form';
        data.message_whatsapp_text = document.getElementById('data_message_whatsapp_text')?.value || 'WhatsApp';
        data.message_whatsapp_url = document.getElementById('data_message_whatsapp_url')?.value || '';
        
        // Contact Option 2 - Call
        data.call_heading = document.getElementById('data_call_heading')?.value || 'Give us a Call';
        data.call_description = document.getElementById('data_call_description')?.value || '';
        data.phone_1 = document.getElementById('data_phone_1')?.value || '';
        data.phone_2 = document.getElementById('data_phone_2')?.value || '';
        
        // Form Section
        data.form_heading = document.getElementById('data_form_heading')?.value || 'Request A Quotation';
        data.form_subheading = document.getElementById('data_form_subheading')?.value || '';
        data.submit_text = document.getElementById('data_submit_text')?.value || 'Submit Form';
        data.form_whatsapp_text = document.getElementById('data_form_whatsapp_text')?.value || 'WhatsApp Now';
        data.form_whatsapp_url = document.getElementById('data_form_whatsapp_url')?.value || '';
        data.privacy_text = document.getElementById('data_privacy_text')?.value || 'We don\'t share your data.';
        data.privacy_url = document.getElementById('data_privacy_url')?.value || '/privacy-policy';
        
        // Map Section
        data.map_heading = document.getElementById('data_map_heading')?.value || 'How to find us';
        data.office_name = document.getElementById('data_office_name')?.value || 'Pro Clean AC - Dubai Office';
        data.office_address = document.getElementById('data_office_address')?.value || '';
        data.office_phone_1 = document.getElementById('data_office_phone_1')?.value || '';
        data.office_phone_2 = document.getElementById('data_office_phone_2')?.value || '';
        data.office_email = document.getElementById('data_office_email')?.value || '';
        data.map_embed_url = document.getElementById('data_map_embed_url')?.value || '';
    } else if (type === 'about-ct-section') {
        data.heading = document.getElementById('data_heading')?.value || 'Interested in booking a visit with Pro Clean AC?';
        data.button_text = document.getElementById('data_button_text')?.value || 'Plan A Visit';
        data.button_link = document.getElementById('data_button_link')?.value || '/contact';
    } else if (type === 'what-we-do') {
        data.heading = document.getElementById('data_heading')?.value || '';
        const items = [];
        document.querySelectorAll('.what-item').forEach(item => {
            const icon = item.querySelector('.what-icon')?.value;
            const title = item.querySelector('.what-title')?.value;
            const desc = item.querySelector('.what-desc')?.value;
            if (title && (icon || desc)) {
                items.push({ icon, title, description: desc });
            }
        });
        data.items = items;
    } else if (type === 'pro-clean') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        const tabs = [];
        document.querySelectorAll('.pro-tab-item').forEach(item => {
            const tab = {
                tab_label: item.querySelector('.pro-tab-label')?.value || '',
                title: item.querySelector('.pro-tab-title')?.value || '',
                content: item.querySelector('.pro-tab-content')?.value || '',
                image: item.querySelector('.pro-tab-image')?.value || '',
                image_alt: item.querySelector('.pro-tab-alt')?.value || '',
            };
            if (tab.tab_label || tab.title || tab.content || tab.image) {
                tabs.push(tab);
            }
        });
        data.tabs = tabs;
    } else if (type === 'plan-visit') {
        data.heading = document.getElementById('data_heading')?.value || '';
        data.btn_text = document.getElementById('data_btn_text')?.value || '';
        data.btn_link = document.getElementById('data_btn_link')?.value || '';
    } else if (type === 'free-quotation') {
        data.heading_before = document.getElementById('data_heading_before')?.value || '';
        data.link_text = document.getElementById('data_link_text')?.value || '';
        data.link_url = document.getElementById('data_link_url')?.value || '';
        data.heading_after = document.getElementById('data_heading_after')?.value || '';
        data.description = document.getElementById('data_description')?.value || '';
        data.btn_text = document.getElementById('data_btn_text')?.value || '';
        data.btn_link = document.getElementById('data_btn_link')?.value || '';
    } else if (type === 'about-top-content') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'about-2nd-section') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'service-top-section') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'service-below-2nd-section') {
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'service-4th-blue-section') {
        data.heading = document.getElementById('data_heading')?.value || '';
        data.left_content = document.getElementById('data_left_content')?.value || '';
        data.right_content = document.getElementById('data_right_content')?.value || '';
    } else if (type === 'service-4th-section') {
        data.heading = document.getElementById('data_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
        data.button_text = document.getElementById('data_button_text')?.value || 'Contact Now';
        data.button_link = document.getElementById('data_button_link')?.value || '/contact';
        data.link_text = document.getElementById('data_link_text')?.value || 'Plan A Visit';
        data.link_url = document.getElementById('data_link_url')?.value || '/contact';
        data.image_url = document.getElementById('data_image_url')?.value || '';
        data.image_alt = document.getElementById('data_image_alt')?.value || 'AC duct cleaning';
    } else if (type === 'service-3rd-section') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
        data.image_alt = document.getElementById('data_image_alt')?.value || '';

        const imageSource = document.querySelector('input[name="service_3rd_image_source"]:checked')?.value || 'upload';
        data.image_source = imageSource;

        if (imageSource === 'url') {
            data.image_url = document.getElementById('data_service_3rd_image_url')?.value || '';
        } else {
            data.image_url = null;
        }
    } else if (type === 'service-form-section') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.submit_text = document.getElementById('data_submit_text')?.value || '';
        data.whatsapp_text = document.getElementById('data_whatsapp_text')?.value || '';
        data.whatsapp_url = document.getElementById('data_whatsapp_url')?.value || '';
        data.privacy_text = document.getElementById('data_privacy_text')?.value || 'We dont share your data.';
        data.privacy_url = document.getElementById('data_privacy_url')?.value || '/privacy-policy';
    } else if (NewDesignAdmin.isType(type)) {
        Object.assign(data, NewDesignAdmin.collectData(type));
    } else if (IrhasAdmin.isType(type)) {
        Object.assign(data, IrhasAdmin.collectData(type));
    } else if (type === 'new-full') {
        data.title = document.getElementById('data_title')?.value || '';
    }
    
    document.getElementById('data_json').value = JSON.stringify(data);
});

function renderServicePageMap() {
    const container = document.getElementById('servicePageMapContainer');
    if (!container) return;
    const serviceSelect = document.getElementById('data_service_ids');
    const selected = Array.from(serviceSelect.selectedOptions).map(o => ({ id: parseInt(o.value), title: o.text }));
    const existingMap = existingData.service_page_map || {};
    container.innerHTML = selected.map(s => {
        const options = ['<option value=\"\">-- Select page --</option>'].concat(
            pagesData.map(p => `<option value=\"${p.id}\" ${existingMap[s.id] == p.id ? 'selected' : ''}>${p.title}</option>`)
        ).join('');
        return `
            <div class="mb-2">
                <label class="form-label d-block">Link for: ${s.title}</label>
                <select class="form-select service-page-map-select" data-service-id="${s.id}">
                    ${options}
                </select>
            </div>
        `;
    }).join('');
}

// Toggle function for About Services Section image source
function toggleAboutServicesImageSource() {
    const uploadRadio = document.getElementById('about_services_image_source_upload');
    const urlRadio = document.getElementById('about_services_image_source_url');
    const uploadSection = document.getElementById('about_services_image_upload');
    const urlSection = document.getElementById('about_services_image_url');
    
    if (uploadRadio && uploadRadio.checked && uploadSection && urlSection) {
        uploadSection.style.display = 'block';
        urlSection.style.display = 'none';
    } else if (urlRadio && urlRadio.checked && uploadSection && urlSection) {
        uploadSection.style.display = 'none';
        urlSection.style.display = 'block';
    }
}

// Toggle function for Contact Hero Background Image source
function toggleContactHeroBgImageSource() {
    const uploadRadio = document.getElementById('contact_hero_bg_image_source_upload');
    const urlRadio = document.getElementById('contact_hero_bg_image_source_url');
    const uploadSection = document.getElementById('contact_hero_bg_image_upload');
    const urlSection = document.getElementById('contact_hero_bg_image_url');
    
    if (uploadRadio && uploadRadio.checked && uploadSection && urlSection) {
        uploadSection.style.display = 'block';
        urlSection.style.display = 'none';
    } else if (urlRadio && urlRadio.checked && uploadSection && urlSection) {
        uploadSection.style.display = 'none';
        urlSection.style.display = 'block';
    }
}

// Initialize on page load
updateDataFields();
</script>
@endpush

