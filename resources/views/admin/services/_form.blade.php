@php
    $serviceModel = $service ?? null;
    $accordions = old('accordions_json')
        ? json_decode(old('accordions_json'), true)
        : ($serviceModel->accordions ?? []);
    $testimonials = old('sidebar_testimonials_json')
        ? json_decode(old('sidebar_testimonials_json'), true)
        : ($serviceModel->sidebar_testimonials ?? []);
@endphp

<div class="row">
    <div class="col-lg-8">
        <h5 class="mb-3">Service Details</h5>
        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $serviceModel->title ?? '') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                value="{{ old('slug', $serviceModel->slug ?? '') }}" placeholder="auto-generated-from-title">
            <small class="text-muted">URL: /services/<span id="slug-preview">{{ old('slug', $serviceModel->slug ?? 'your-slug') }}</span></small>
            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="service_category_id" class="form-label">Category</label>
                <select class="form-select @error('service_category_id') is-invalid @enderror" id="service_category_id" name="service_category_id">
                    <option value="">-- Select Category --</option>
                    @foreach(($categories ?? []) as $category)
                        <option value="{{ $category->id }}" {{ (string) old('service_category_id', $serviceModel->service_category_id ?? '') === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">
                    <a href="{{ route('admin.service-categories.index') }}" target="_blank">Manage categories</a>
                </small>
                @error('service_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="published_at" class="form-label">Published Date</label>
                <input type="date" class="form-control" id="published_at" name="published_at"
                    value="{{ old('published_at', optional($serviceModel->published_at ?? null)->format('Y-m-d')) }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="excerpt" class="form-label">Excerpt / Short Intro</label>
            <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $serviceModel->excerpt ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Main Content</label>
            <textarea class="form-control wysiwyg-editor" id="content" name="content" rows="10">{{ old('content', $serviceModel->content ?? '') }}</textarea>
            <small class="text-muted">Full service detail body (supports HTML).</small>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Legacy Description (optional)</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $serviceModel->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="features_section_title" class="form-label">Features Section Title</label>
            <input type="text" class="form-control" id="features_section_title" name="features_section_title"
                value="{{ old('features_section_title', $serviceModel->features_section_title ?? '') }}"
                placeholder="We are Establish Company for It Business">
        </div>

        <h6 class="mt-4">Accordion Items</h6>
        <div id="accordions-repeater"></div>
        <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="add-accordion">Add Accordion</button>
        <input type="hidden" name="accordions_json" id="accordions_json" value="{{ old('accordions_json', json_encode($accordions)) }}">

        <h6 class="mt-4">Sidebar Testimonials</h6>
        <div id="testimonials-repeater"></div>
        <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="add-testimonial">Add Testimonial</button>
        <input type="hidden" name="sidebar_testimonials_json" id="sidebar_testimonials_json" value="{{ old('sidebar_testimonials_json', json_encode($testimonials)) }}">
    </div>

    <div class="col-lg-4">
        <h5 class="mb-3">Media & Settings</h5>
        <div class="mb-3">
            <label for="image" class="form-label">Hero / Thumbnail Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if(!empty($serviceModel->image))
                <img src="{{ $serviceModel->imageUrl('image') }}" alt="" class="img-thumbnail mt-2" style="max-height:120px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="image_alt" class="form-label">Hero Image Alt Text</label>
            <input type="text" class="form-control" id="image_alt" name="image_alt" value="{{ old('image_alt', $serviceModel->image_alt ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="content_image" class="form-label">Content Image</label>
            <input type="file" class="form-control" id="content_image" name="content_image" accept="image/*">
            @if(!empty($serviceModel->content_image))
                <img src="{{ $serviceModel->imageUrl('content_image') }}" alt="" class="img-thumbnail mt-2" style="max-height:120px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="brochure_doc_url" class="form-label">Brochure Doc URL</label>
            <input type="text" class="form-control" id="brochure_doc_url" name="brochure_doc_url" value="{{ old('brochure_doc_url', $serviceModel->brochure_doc_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="brochure_pdf_url" class="form-label">Brochure PDF URL</label>
            <input type="text" class="form-control" id="brochure_pdf_url" name="brochure_pdf_url" value="{{ old('brochure_pdf_url', $serviceModel->brochure_pdf_url ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="sort_order" class="form-label">Sort Order</label>
            <input type="number" class="form-control" id="sort_order" name="sort_order" min="0" value="{{ old('sort_order', $serviceModel->sort_order ?? 0) }}">
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                    {{ old('status', $serviceModel->status ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Published / Active</label>
            </div>
        </div>

        <hr>
        <h5 class="mb-3">SEO</h5>
        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $serviceModel->meta_title ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $serviceModel->meta_description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="2">{{ old('meta_keywords', $serviceModel->meta_keywords ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="og_title" class="form-label">OG Title</label>
            <input type="text" class="form-control" id="og_title" name="og_title" value="{{ old('og_title', $serviceModel->og_title ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="og_description" class="form-label">OG Description</label>
            <textarea class="form-control" id="og_description" name="og_description" rows="2">{{ old('og_description', $serviceModel->og_description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="og_image" class="form-label">OG Image URL</label>
            <input type="text" class="form-control" id="og_image" name="og_image" value="{{ old('og_image', $serviceModel->og_image ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="canonical_url" class="form-label">Canonical URL</label>
            <input type="url" class="form-control" id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $serviceModel->canonical_url ?? '') }}">
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    let accordions = @json($accordions ?: []);
    let testimonials = @json($testimonials ?: []);

    function esc(value) {
        return String(value ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function renderAccordions() {
        const container = document.getElementById('accordions-repeater');
        container.innerHTML = (accordions.length ? accordions : [{ title: '', content: '' }]).map((item, index) => `
            <div class="border rounded p-3 mb-2 accordion-item" data-index="${index}">
                <div class="mb-2"><label class="form-label">Title</label><input type="text" class="form-control acc-title" value="${esc(item.title)}"></div>
                <div class="mb-2"><label class="form-label">Content</label><textarea class="form-control acc-content" rows="3">${esc(item.content)}</textarea></div>
                <button type="button" class="btn btn-sm btn-danger remove-accordion">Remove</button>
            </div>
        `).join('');
        bindAccordionEvents();
        syncAccordions();
    }

    function renderTestimonials() {
        const container = document.getElementById('testimonials-repeater');
        container.innerHTML = (testimonials.length ? testimonials : [{ author: '', job: '', quote: '', image: '' }]).map((item, index) => `
            <div class="border rounded p-3 mb-2 testimonial-item" data-index="${index}">
                <div class="mb-2"><label class="form-label">Author</label><input type="text" class="form-control testi-author" value="${esc(item.author)}"></div>
                <div class="mb-2"><label class="form-label">Job / Role</label><input type="text" class="form-control testi-job" value="${esc(item.job)}"></div>
                <div class="mb-2"><label class="form-label">Quote</label><textarea class="form-control testi-quote" rows="2">${esc(item.quote)}</textarea></div>
                <div class="mb-2"><label class="form-label">Image (path or URL)</label><input type="text" class="form-control testi-image" value="${esc(item.image)}" placeholder="img/testimonial-profile.png"></div>
                <button type="button" class="btn btn-sm btn-danger remove-testimonial">Remove</button>
            </div>
        `).join('');
        bindTestimonialEvents();
        syncTestimonials();
    }

    function syncAccordions() {
        const items = [];
        document.querySelectorAll('.accordion-item').forEach((row) => {
            const title = row.querySelector('.acc-title')?.value.trim() || '';
            const content = row.querySelector('.acc-content')?.value.trim() || '';
            if (title || content) items.push({ title, content });
        });
        document.getElementById('accordions_json').value = JSON.stringify(items);
    }

    function syncTestimonials() {
        const items = [];
        document.querySelectorAll('.testimonial-item').forEach((row) => {
            const author = row.querySelector('.testi-author')?.value.trim() || '';
            const job = row.querySelector('.testi-job')?.value.trim() || '';
            const quote = row.querySelector('.testi-quote')?.value.trim() || '';
            const image = row.querySelector('.testi-image')?.value.trim() || '';
            if (author || job || quote || image) items.push({ author, job, quote, image });
        });
        document.getElementById('sidebar_testimonials_json').value = JSON.stringify(items);
    }

    function bindAccordionEvents() {
        document.querySelectorAll('.remove-accordion').forEach((btn) => {
            btn.onclick = function () {
                if (document.querySelectorAll('.accordion-item').length > 1) {
                    this.closest('.accordion-item').remove();
                    syncAccordions();
                }
            };
        });
        document.querySelectorAll('.acc-title, .acc-content').forEach((el) => {
            el.oninput = syncAccordions;
        });
    }

    function bindTestimonialEvents() {
        document.querySelectorAll('.remove-testimonial').forEach((btn) => {
            btn.onclick = function () {
                if (document.querySelectorAll('.testimonial-item').length > 1) {
                    this.closest('.testimonial-item').remove();
                    syncTestimonials();
                }
            };
        });
        document.querySelectorAll('.testi-author, .testi-job, .testi-quote, .testi-image').forEach((el) => {
            el.oninput = syncTestimonials;
        });
    }

    document.getElementById('add-accordion')?.addEventListener('click', () => {
        accordions = JSON.parse(document.getElementById('accordions_json').value || '[]');
        accordions.push({ title: '', content: '' });
        renderAccordions();
    });

    document.getElementById('add-testimonial')?.addEventListener('click', () => {
        testimonials = JSON.parse(document.getElementById('sidebar_testimonials_json').value || '[]');
        testimonials.push({ author: '', job: '', quote: '', image: '' });
        renderTestimonials();
    });

    const slugInput = document.getElementById('slug');
    const titleInput = document.getElementById('title');
    const slugPreview = document.getElementById('slug-preview');
    function updateSlugPreview() {
        if (slugPreview) slugPreview.textContent = slugInput.value || titleInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'your-slug';
    }
    slugInput?.addEventListener('input', updateSlugPreview);
    titleInput?.addEventListener('input', updateSlugPreview);

    document.querySelector('form')?.addEventListener('submit', () => {
        syncAccordions();
        syncTestimonials();
    });

    renderAccordions();
    renderTestimonials();
    updateSlugPreview();

    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.wysiwyg-editor',
            height: 350,
            menubar: false,
            plugins: 'lists link image code',
            toolbar: 'undo redo | bold italic | bullist numlist | link image | code',
        });
    }
})();
</script>
@endpush
