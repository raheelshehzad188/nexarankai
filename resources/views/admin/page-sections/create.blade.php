@extends('admin.layout')

@section('title', 'Create Page Section')

@section('content')
@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
@endphp
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Create New Page Section</h2>
    <a href="{{ route('admin.page-sections.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.page-sections.store') }}" method="POST" id="sectionForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="page_id" class="form-label">Page <span class="text-danger">*</span></label>
                <select class="form-select @error('page_id') is-invalid @enderror" id="page_id" name="page_id" required>
                    <option value="">Select a page</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}" {{ old('page_id') == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
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
                            <option value="{{ $sectionType->slug }}" {{ old('type') == $sectionType->slug ? 'selected' : '' }}>{{ $sectionType->name }}</option>
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
                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">
                        Active
                    </label>
                </div>
            </div>

            <input type="hidden" id="data_json" name="data" value="{}">

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Create Section
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
@include('admin.page-sections.partials.new-design-admin')
@include('admin.page-sections.partials.irhas-admin')
<script>
const pagesData = @json($pages);
const siteName = @json($siteName);
const newDesignDefaults = @json(config('new_design_defaults', []));
const irhasDefaults = @json(config('irhas_defaults', []));

function newDesignFormData(type) {
    return newDesignDefaults[type] || {};
}

function irhasFormData(type) {
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

function destroyWysiwygEditors() {
    const container = document.getElementById('dataFields');
    if (!container || typeof tinymce === 'undefined') return;
    container.querySelectorAll('.wysiwyg-editor').forEach(el => {
        const id = el.id;
        if (id && tinymce.get(id)) tinymce.get(id).remove();
    });
}
function initWysiwygEditors(retryCount) {
    retryCount = retryCount || 0;
    const container = document.getElementById('dataFields');
    if (!container) return;
    const editors = container.querySelectorAll('.wysiwyg-editor');
    if (editors.length === 0) return;
    
    if (typeof tinymce === 'undefined') {
        if (retryCount < 30) setTimeout(() => initWysiwygEditors(retryCount + 1), 200);
        return;
    }
    editors.forEach(el => {
        const id = el.id || ('wysiwyg-' + Math.random().toString(36).substr(2, 9));
        if (!el.id) el.id = id;
    });
    tinymce.init({
        selector: '#dataFields .wysiwyg-editor',
        height: 280,
        menubar: false,
        plugins: 'lists link image code',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
        content_style: 'body { font-family: inherit; font-size: 14px; }',
        promotion: false,
        branding: false
    });
}
function syncWysiwygEditors() {
    if (typeof tinymce !== 'undefined') tinymce.triggerSave();
}
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
                <input type="text" class="form-control" id="data_title" placeholder="Title" value="{{ old('data.title') }}">
            </div>
            <div class="mb-2">
                <input type="text" class="form-control" id="data_subtitle" placeholder="Subtitle" value="{{ old('data.subtitle') }}">
            </div>
        `;
    } else if (type === 'about-hero') {
        html = `
            <label class="form-label">About Hero Banner</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="About Us" value="{{ old('data.heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Subheading</label>
                <textarea class="form-control" id="data_subheading" rows="2" placeholder="Short tagline">{{ old('data.subheading') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Banner Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="about_image_source" id="about_image_source_upload" value="upload" checked>
                    <label class="btn btn-outline-primary" for="about_image_source_upload">Upload Image</label>
                    
                    <input type="radio" class="btn-check" name="about_image_source" id="about_image_source_url" value="url">
                    <label class="btn btn-outline-primary" for="about_image_source_url">Image URL</label>
                </div>
            </div>
            <div class="mb-2" id="about_image_upload">
                <label class="form-label">Upload Banner Image</label>
                <input type="file" class="form-control" id="data_about_image_file" name="about_image_file" accept="image/*">
                <small class="form-text text-muted">Recommended: 1600x600px, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="about_image_url" style="display: none;">
                <label class="form-label">Banner Image URL</label>
                <input type="url" class="form-control" id="data_about_image_url" placeholder="https://example.com/banner.jpg" value="{{ old('data.image_url') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Minimum Height (px)</label>
                <input type="number" class="form-control" id="data_min_height" placeholder="e.g., 380" value="{{ old('data.min_height', 380) }}">
            </div>
        `;
    } else if (type === 'home-hero') {
        html = `
            <label class="form-label">Home Hero Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Welcome to Our Site" value="{{ old('data.heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Paragraph</label>
                <textarea class="form-control wysiwyg-editor" id="data_paragraph" rows="3" placeholder="Enter description text">{{ old('data.paragraph') }}</textarea>
            </div>
            
            <h6 class="mt-4 mb-2">Logo Image</h6>
            <div class="mb-3">
                <label class="form-label">Logo Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="home_logo_image_source" id="home_logo_image_source_upload" value="upload" checked>
                    <label class="btn btn-outline-primary" for="home_logo_image_source_upload">Upload Logo</label>
                    
                    <input type="radio" class="btn-check" name="home_logo_image_source" id="home_logo_image_source_url" value="url">
                    <label class="btn btn-outline-primary" for="home_logo_image_source_url">Logo URL</label>
                </div>
            </div>
            <div class="mb-2" id="home_logo_image_upload">
                <label class="form-label">Upload Logo Image</label>
                <input type="file" class="form-control" id="data_home_logo_image_file" name="home_logo_image_file" accept="image/*">
                <small class="form-text text-muted">Recommended: PNG with transparent background (max 5MB)</small>
            </div>
            <div class="mb-2" id="home_logo_image_url" style="display: none;">
                <label class="form-label">Logo Image URL</label>
                <input type="url" class="form-control" id="data_home_logo_image_url" placeholder="https://example.com/logo.png" value="{{ old('data.logo_image_url') }}">
            </div>
            
            <h6 class="mt-4 mb-2">Background Image</h6>
            <div class="mb-3">
                <label class="form-label">Background Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="home_background_image_source" id="home_background_image_source_upload" value="upload" checked>
                    <label class="btn btn-outline-primary" for="home_background_image_source_upload">Upload Image</label>
                    
                    <input type="radio" class="btn-check" name="home_background_image_source" id="home_background_image_source_url" value="url">
                    <label class="btn btn-outline-primary" for="home_background_image_source_url">Image URL</label>
                </div>
            </div>
            <div class="mb-2" id="home_background_image_upload">
                <label class="form-label">Upload Background Image</label>
                <input type="file" class="form-control" id="data_home_background_image_file" name="home_background_image_file" accept="image/*">
                <small class="form-text text-muted">Recommended: 1920x1080px, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="home_background_image_url" style="display: none;">
                <label class="form-label">Background Image URL</label>
                <input type="url" class="form-control" id="data_home_background_image_url" placeholder="https://example.com/background.jpg" value="{{ old('data.background_image_url') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Minimum Height (px)</label>
                <input type="number" class="form-control" id="data_min_height" placeholder="e.g., 500" value="{{ old('data.min_height', 500) }}">
            </div>
        `;
    } else if (type === 'video-hero') {
        html = `
            <label class="form-label">Video Hero Data</label>
            <div class="mb-3">
                <label class="form-label">Video Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="video_source" id="video_source_youtube" value="youtube" checked>
                    <label class="btn btn-outline-primary" for="video_source_youtube">YouTube Link</label>
                    
                    <input type="radio" class="btn-check" name="video_source" id="video_source_mp4" value="mp4">
                    <label class="btn btn-outline-primary" for="video_source_mp4">MP4 Video Link</label>
                    
                    <input type="radio" class="btn-check" name="video_source" id="video_source_upload" value="upload">
                    <label class="btn btn-outline-primary" for="video_source_upload">Upload Video</label>
                </div>
            </div>
            <div class="mb-2" id="youtube_source">
                <label class="form-label">YouTube Video Link</label>
                <input type="url" class="form-control" id="data_youtube_link" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('data.youtube_link') }}">
                <small class="form-text text-muted">Enter full YouTube URL or video ID</small>
            </div>
            <div class="mb-2" id="mp4_source" style="display: none;">
                <label class="form-label">MP4 Video Link (CDN/External URL)</label>
                <input type="url" class="form-control" id="data_mp4_link" placeholder="https://cdn.example.com/video.mp4" value="{{ old('data.mp4_link') }}">
                <small class="form-text text-muted">Enter direct MP4 video URL (e.g., CDN link). Video will autoplay in background.</small>
            </div>
            <div class="mb-2" id="upload_source" style="display: none;">
                <label class="form-label">Upload Video File</label>
                <input type="file" class="form-control" id="data_video_file" name="video_file" accept="video/*">
                <small class="form-text text-muted">Supported formats: MP4, WebM, OGG (Max size: 50MB)</small>
                <div id="video_preview" class="mt-2" style="display: none;">
                    <video id="preview_video" width="100%" height="200" controls style="max-width: 500px;"></video>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Main Heading" value="{{ old('data.heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Short Detail</label>
                <textarea class="form-control wysiwyg-editor" id="data_short_detail" rows="3" placeholder="Short description">{{ old('data.short_detail') }}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_btn_text" placeholder="Click Here" value="{{ old('data.btn_text') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_btn_link" placeholder="https://example.com" value="{{ old('data.btn_link') }}">
            </div>
        `;
    } else if (type === 'content') {
        html = `
            <label class="form-label">Content</label>
            <textarea class="form-control wysiwyg-editor" id="data_content" rows="10" placeholder="Enter HTML content">{{ old('data.content') }}</textarea>
            <small class="form-text text-muted">You can use HTML tags</small>
        `;
    } else if (type === 'our-services') {
        html = `
            <label class="form-label">Our Services Data</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Our Services" value="{{ old('data.short_heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., What {{ $siteName }} can do for you." value="{{ old('data.main_heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Services</label>
                <select class="form-select" id="data_service_ids" multiple onchange="renderServicePageMap()">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                    @endforeach
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
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Who We Are" value="{{ old('data.short_heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., How can {{ $siteName }} help you?" value="{{ old('data.main_heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="10" placeholder="Enter content text...">{{ old('data.content') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'trusted-partner') {
        html = `
            <label class="form-label">Trusted Partner Data</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., A trusted partner" value="{{ old('data.short_heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., We are NADCA Accredited" value="{{ old('data.main_heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="5" placeholder="Enter content text...">{{ old('data.content') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="image_source" id="image_source_url" value="url" checked>
                    <label class="btn btn-outline-primary" for="image_source_url">Image URL</label>
                    
                    <input type="radio" class="btn-check" name="image_source" id="image_source_upload" value="upload">
                    <label class="btn btn-outline-primary" for="image_source_upload">Upload Image</label>
                </div>
            </div>
            <div class="mb-2" id="image_url_source">
                <label class="form-label">Image URL</label>
                <input type="url" class="form-control" id="data_image_url" placeholder="https://example.com/image.png" value="{{ old('data.image_url') }}">
                <small class="form-text text-muted">Enter direct URL to image (e.g., CDN link)</small>
            </div>
            <div class="mb-2" id="image_upload_source" style="display: none;">
                <label class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="data_image_file" name="image_file" accept="image/*">
                <small class="form-text text-muted">Supported formats: JPG, PNG, GIF (Max size: 5MB)</small>
                <div id="image_preview" class="mt-2" style="display: none;">
                    <img id="preview_image" width="100%" height="200" style="max-width: 500px; object-fit: contain;">
                </div>
            </div>
        `;
    } else if (type === 'faq') {
        html = `
            <label class="form-label">FAQ Items</label>
            <div id="faqItems">
                <div class="faq-item mb-3 p-3 border rounded">
                    <div class="mb-2">
                        <input type="text" class="form-control faq-question" placeholder="Question">
                    </div>
                    <div>
                        <textarea class="form-control wysiwyg-editor faq-answer" rows="2" placeholder="Answer"></textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq">Remove</button>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-primary" id="addFaq">Add FAQ Item</button>
        `;
    } else if (type === 'contact-form') {
        html = `
            <label class="form-label">Contact Form Data</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="Request A Quotation" value="{{ old('data.heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Subheading</label>
                <input type="text" class="form-control" id="data_subheading" placeholder="Fill in the form below and our team will be in touch to discuss your AC Cleaning quote." value="{{ old('data.subheading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Submit Button Text</label>
                <input type="text" class="form-control" id="data_submit_text" placeholder="Submit Form" value="{{ old('data.submit_text') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Button Text</label>
                <input type="text" class="form-control" id="data_whatsapp_text" placeholder="WhatsApp Now" value="{{ old('data.whatsapp_text') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Link</label>
                <input type="url" class="form-control" id="data_whatsapp_url" placeholder="https://wa.me/+971556382341" value="{{ old('data.whatsapp_url') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Text</label>
                <input type="text" class="form-control" id="data_privacy_text" placeholder="We don’t share your data." value="{{ old('data.privacy_text') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Link</label>
                <input type="url" class="form-control" id="data_privacy_url" placeholder="/privacy-policy" value="{{ old('data.privacy_url') }}">
            </div>
        `;
    } else if (type === 'what-we-do') {
        html = `
            <label class="form-label">What We Do</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="What We Do." value="{{ old('data.heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Items</label>
                <div id="whatWeDoItems">
                    <div class="what-item mb-3 p-3 border rounded">
                        <div class="mb-2">
                            <label class="form-label">Icon URL</label>
                            <input type="url" class="form-control what-icon" placeholder="https://..." value="{{ old('data.items.0.icon') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control what-title" placeholder="Duct Cleaning" value="{{ old('data.items.0.title') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description</label>
                            <textarea class="form-control wysiwyg-editor what-desc" rows="2" placeholder="Description">{{ old('data.items.0.description') }}</textarea>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger remove-what">Remove</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="addWhat">Add Item</button>
            </div>
        `;
    } else if (type === 'pro-clean') {
        html = `
            <label class="form-label">Pro Clean Tabs</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="Why {{ $siteName }}?" value="{{ old('data.short_heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="What makes us different?" value="{{ old('data.main_heading') }}">
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
                <input type="text" class="form-control" id="data_heading" placeholder="Interested in booking a visit with {{ $siteName }}?" value="{{ old('data.heading') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_btn_text" placeholder="Plan A Visit" value="{{ old('data.btn_text') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_btn_link" placeholder="/contact" value="{{ old('data.btn_link', '/contact') }}">
            </div>
        `;
    } else if (type === 'free-quotation') {
        html = `
            <label class="form-label">Free Quotation</label>
            <div class="mb-2">
                <label class="form-label">Heading (Text Before Link)</label>
                <input type="text" class="form-control" id="data_heading_before" placeholder="Get a" value="{{ old('data.heading_before', 'Get a') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Link Text</label>
                <input type="text" class="form-control" id="data_link_text" placeholder="free quotation" value="{{ old('data.link_text', 'free quotation') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Link URL</label>
                <input type="url" class="form-control" id="data_link_url" placeholder="/contact" value="{{ old('data.link_url', '/contact') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Heading (Text After Link)</label>
                <input type="text" class="form-control" id="data_heading_after" placeholder="today!" value="{{ old('data.heading_after', 'today!') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Description</label>
                <textarea class="form-control wysiwyg-editor" id="data_description" rows="3" placeholder="Click below to plan a visit with the {{ $siteName }} team. Our team of experts will help guide, advise and execute any AC cleaning related work that you need.">{{ old('data.description', 'Click below to plan a visit with the ' . $siteName . ' team. Our team of experts will help guide, advise and execute any AC cleaning related work that you need.') }}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_btn_text" placeholder="Free Quotation" value="{{ old('data.btn_text', 'Free Quotation') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_btn_link" placeholder="/contact" value="{{ old('data.btn_link', '/contact') }}">
            </div>
        `;
    } else if (type === 'about-top-content') {
        html = `
            <label class="form-label">About Top Content</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="About Us" value="{{ old('data.short_heading', 'About Us') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="Cleaner air for you and your family." value="{{ old('data.main_heading', 'Cleaner air for you and your family.') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="8" placeholder="Enter content text...">{{ old('data.content', 'At ' . $siteName . ' our staff are trained by British engineers. We come fully equipped on time with a friendly attitude. We can service your villa, apartment, or work place with our industry leading Machines.') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'service-top-section') {
        html = `
            <label class="form-label">Service Top Section</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Duct Cleaning" value="{{ old('data.short_heading', '') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., Pro Clean AC are Dubai's Experts in Duct Cleaning." value="{{ old('data.main_heading', '') }}">
                <small class="form-text text-muted">You can use &nbsp; for non-breaking spaces.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="10" placeholder="Enter content text...">{{ old('data.content', '') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'service-below-section') {
        html = `
            <label class="form-label">Service Below 2nd Section</label>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="12" placeholder="Enter content text...">{{ old('data.content', '') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security. Use &lt;strong&gt; tags for bold text.</small>
            </div>
        `;
    } else if (type === 'service-4th-blue-section') {
        html = `
            <label class="form-label">Service 4th Blue Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="e.g., Maintaining Good Air Quality" value="{{ old('data.heading', '') }}">
                <small class="form-text text-muted">You can use &lt;strong&gt; tags for bold text. Example: &lt;strong&gt;Maintaining Good Air Quality&lt;/strong&gt;</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Left Column Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_left_content" rows="8" placeholder="Enter left column content...">{{ old('data.left_content', '') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Right Column Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_right_content" rows="8" placeholder="Enter right column content...">{{ old('data.right_content', '') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
        `;
    } else if (type === 'service-4th-section') {
        html = `
            <label class="form-label">Service 4th Section</label>
            <div class="mb-2">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" id="data_heading" placeholder="e.g., Save money on your bills." value="{{ old('data.heading', '') }}">
                <small class="form-text text-muted">You can use &lt;strong&gt; tags for bold text. Example: &lt;strong&gt;Save money on your bills.&lt;/strong&gt;</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="6" placeholder="Enter content text...">{{ old('data.content', '') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" id="data_button_text" placeholder="Contact Now" value="{{ old('data.button_text', 'Contact Now') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Button Link</label>
                <input type="url" class="form-control" id="data_button_link" placeholder="/contact" value="{{ old('data.button_link', '/contact') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Link Text</label>
                <input type="text" class="form-control" id="data_link_text" placeholder="Plan A Visit" value="{{ old('data.link_text', 'Plan A Visit') }}">
                <small class="form-text text-muted">Text for the link next to button</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Link URL</label>
                <input type="url" class="form-control" id="data_link_url" placeholder="/contact" value="{{ old('data.link_url', '/contact') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Image URL</label>
                <input type="url" class="form-control" id="data_image_url" placeholder="https://..." value="{{ old('data.image_url', '') }}">
                <small class="form-text text-muted">Right side image URL</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Image Alt Text</label>
                <input type="text" class="form-control" id="data_image_alt" placeholder="AC duct cleaning" value="{{ old('data.image_alt', 'AC duct cleaning') }}">
            </div>
        `;
    } else if (type === 'service-form-section') {
        html = `
            <label class="form-label">Service Form Section</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Request A Quotation" value="{{ old('data.short_heading', 'Request A Quotation') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <textarea class="form-control wysiwyg-editor" id="data_main_heading" rows="2" placeholder="e.g., Fill in the form below and our team will be in touch to discuss your quote.">{{ old('data.main_heading', 'Fill in the form below and our team will be in touch to discuss your quote.') }}</textarea>
                <small class="form-text text-muted">You can use &nbsp; for non-breaking spaces.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Submit Button Text</label>
                <input type="text" class="form-control" id="data_submit_text" placeholder="Submit Form" value="{{ old('data.submit_text', 'Submit Form') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp Button Text</label>
                <input type="text" class="form-control" id="data_whatsapp_text" placeholder="WhatsApp Now" value="{{ old('data.whatsapp_text', 'WhatsApp Now') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">WhatsApp URL</label>
                <input type="url" class="form-control" id="data_whatsapp_url" placeholder="https://wa.me/+971556382341" value="{{ old('data.whatsapp_url', 'https://wa.me/+971556382341') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Text</label>
                <input type="text" class="form-control" id="data_privacy_text" placeholder="We don't share your data." value="{{ old('data.privacy_text', 'We dont share your data.') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Privacy Policy URL</label>
                <input type="url" class="form-control" id="data_privacy_url" placeholder="/privacy-policy" value="{{ old('data.privacy_url', '/privacy-policy') }}">
            </div>
        `;
    } else if (type === 'service-3rd-section') {
        html = `
            <label class="form-label">Service 3rd Section</label>
            <div class="mb-2">
                <label class="form-label">Short Heading</label>
                <input type="text" class="form-control" id="data_short_heading" placeholder="e.g., Dubai's experts in AC Cleaning" value="{{ old('data.short_heading', '') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Main Heading</label>
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., When to clean your AC ducts?" value="{{ old('data.main_heading', '') }}">
                <small class="form-text text-muted">You can use &nbsp; for non-breaking spaces.</small>
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control wysiwyg-editor" id="data_content" rows="10" placeholder="Enter content text...">{{ old('data.content', '') }}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Image Source</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="service_3rd_image_source" id="service_3rd_image_source_upload" value="upload" checked>
                    <label class="btn btn-outline-primary" for="service_3rd_image_source_upload">Upload Image</label>
                    
                    <input type="radio" class="btn-check" name="service_3rd_image_source" id="service_3rd_image_source_url" value="url">
                    <label class="btn btn-outline-primary" for="service_3rd_image_source_url">Image URL</label>
                </div>
            </div>
            <div class="mb-2" id="service_3rd_image_upload">
                <label class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="data_service_3rd_image_file" name="service_3rd_image_file" accept="image/*">
                <small class="form-text text-muted">Recommended: 612px width, JPG/PNG/WebP (max 5MB)</small>
            </div>
            <div class="mb-2" id="service_3rd_image_url" style="display: none;">
                <label class="form-label">Image URL</label>
                <input type="url" class="form-control" id="data_service_3rd_image_url" placeholder="https://example.com/image.jpg" value="{{ old('data.image_url') }}">
            </div>
            <div class="mb-2">
                <label class="form-label">Image Alt Text</label>
                <input type="text" class="form-control" id="data_image_alt" placeholder="e.g., Duct cleaning Dubai" value="{{ old('data.image_alt', '') }}">
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
                <input type="text" class="form-control" id="data_title" placeholder="Enter title" value="{{ old('data.title') }}">
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
                    <textarea class="form-control faq-answer" rows="2" placeholder="Answer"></textarea>
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
                        <textarea class="form-control what-desc" rows="2" placeholder="Description"></textarea>
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

        const renderTabs = (tabs) => {
            if (!container) return;
            container.innerHTML = '';
            tabs.forEach((tab, index) => {
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
                    ${tabs.length > 1 ? '<button type="button" class="btn btn-sm btn-danger remove-pro-tab">Remove</button>' : ''}
                `;
                container.appendChild(item);

                const removeBtn = item.querySelector('.remove-pro-tab');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        tabs.splice(index, 1);
                        renderTabs(tabs);
                    });
                }
            });
        };

        if (container) {
            const tabs = defaultTabs.map(tab => ({ ...tab }));
            renderTabs(tabs);

            addBtn?.addEventListener('click', function() {
                tabs.push({ tab_label: '', title: '', content: '', image: '', image_alt: '' });
                renderTabs(tabs);
            });
        }
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
            data.image = null;
        } else {
            data.image_url = null;
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
        } else {
            data.background_image_url = null;
        }
        
        // Handle logo image
        if (logoImageSource === 'url') {
            data.logo_image_url = document.getElementById('data_home_logo_image_url')?.value || '';
        } else {
            data.logo_image_url = null;
        }
    } else if (type === 'video-hero') {
        const videoSource = document.querySelector('input[name="video_source"]:checked')?.value || 'youtube';
        data.video_source = videoSource;
        
        if (videoSource === 'youtube') {
            data.youtube_link = document.getElementById('data_youtube_link')?.value || '';
            data.mp4_link = null;
            data.video_file = null;
        } else if (videoSource === 'mp4') {
            data.mp4_link = document.getElementById('data_mp4_link')?.value || '';
            data.youtube_link = null;
            data.video_file = null;
        } else {
            data.youtube_link = null;
            data.mp4_link = null;
            // Video file will be uploaded separately
            const videoFile = document.getElementById('data_video_file')?.files[0];
            if (videoFile) {
                // File is already in form, will be sent automatically
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
            data.image = null;
        } else {
            data.image_url = null;
            // Image file will be uploaded separately
            const imageFile = document.getElementById('data_image_file')?.files[0];
            if (imageFile) {
                // File is already in form, will be sent automatically
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
    } else if (type === 'service-top-section') {
        data.short_heading = document.getElementById('data_short_heading')?.value || '';
        data.main_heading = document.getElementById('data_main_heading')?.value || '';
        data.content = document.getElementById('data_content')?.value || '';
    } else if (type === 'service-below-section') {
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
        data.privacy_text = document.getElementById('data_privacy_text')?.value || '';
        data.privacy_url = document.getElementById('data_privacy_url')?.value || '';
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
    const map = {};
    container.innerHTML = selected.map(s => {
        const options = ['<option value="">-- Select page --</option>'].concat(
            pagesData.map(p => `<option value="${p.id}">${p.title}</option>`)
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

// Initialize on page load
updateDataFields();
</script>
@endpush

