@extends('admin.layout')

@section('title', 'Edit Page Section')

@section('content')
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
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="hero" {{ old('type', $pageSection->type) == 'hero' ? 'selected' : '' }}>Hero</option>
                    <option value="video-hero" {{ old('type', $pageSection->type) == 'video-hero' ? 'selected' : '' }}>Video Hero (YouTube Background)</option>
                    <option value="content" {{ old('type', $pageSection->type) == 'content' ? 'selected' : '' }}>Content</option>
                    <option value="services" {{ old('type', $pageSection->type) == 'services' ? 'selected' : '' }}>Services</option>
                    <option value="our-services" {{ old('type', $pageSection->type) == 'our-services' ? 'selected' : '' }}>Our Services (Multi-Select)</option>
                    <option value="who-we-are" {{ old('type', $pageSection->type) == 'who-we-are' ? 'selected' : '' }}>Who We Are</option>
                    <option value="trusted-partner" {{ old('type', $pageSection->type) == 'trusted-partner' ? 'selected' : '' }}>Trusted Partner</option>
                    <option value="testimonials" {{ old('type', $pageSection->type) == 'testimonials' ? 'selected' : '' }}>Testimonials</option>
                    <option value="clients" {{ old('type', $pageSection->type) == 'clients' ? 'selected' : '' }}>Clients</option>
                    <option value="faq" {{ old('type', $pageSection->type) == 'faq' ? 'selected' : '' }}>FAQ</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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

<script>
const existingData = @json($pageSection->data ?? []);
const servicesData = @json($services);

document.getElementById('type').addEventListener('change', function() {
    updateDataFields();
});

function updateDataFields() {
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
                ${hasVideoFile ? `<div class="mt-2"><small class="text-muted">Current video: <a href="/storage/${existingData.video_file}" target="_blank">View</a></small></div>` : ''}
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
                <textarea class="form-control" id="data_short_detail" rows="3" placeholder="Short description">${existingData.short_detail || ''}</textarea>
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
            <textarea class="form-control" id="data_content" rows="10" placeholder="Enter HTML content">${existingData.content || ''}</textarea>
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
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., What Pro Clean AC can do for you." value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Services</label>
                <select class="form-select" id="data_service_ids" multiple size="8">
                    ${serviceOptions}
                </select>
                <small class="form-text text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple services. Leave empty to show all active services.</small>
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
                <input type="text" class="form-control" id="data_main_heading" placeholder="e.g., How can Pro Clean AC help you?" value="${existingData.main_heading || ''}">
            </div>
            <div class="mb-2">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="data_content" rows="10" placeholder="Enter content text...">${existingData.content || ''}</textarea>
                <small class="form-text text-muted">You can use line breaks. HTML will be escaped for security.</small>
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
                ${hasImage ? `<div class="mt-2"><small class="text-muted">Current image: <a href="/storage/${existingData.image}" target="_blank">View</a></small></div>` : ''}
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
                        <textarea class="form-control faq-answer" rows="2" placeholder="Answer">${faq.answer || ''}</textarea>
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
                        <textarea class="form-control faq-answer" rows="2" placeholder="Answer"></textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq">Remove</button>
                </div>
            `;
        }
        html += `</div><button type="button" class="btn btn-sm btn-primary" id="addFaq">Add FAQ Item</button>`;
    }
    
    dataFields.innerHTML = html;
    
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
}

document.getElementById('sectionForm').addEventListener('submit', function(e) {
    const type = document.getElementById('type').value;
    const data = {};
    
    if (type === 'hero') {
        data.title = document.getElementById('data_title')?.value || '';
        data.subtitle = document.getElementById('data_subtitle')?.value || '';
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
    }
    
    document.getElementById('data_json').value = JSON.stringify(data);
});

// Initialize on page load
updateDataFields();
</script>
@endsection

