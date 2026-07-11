@php
    $postModel = $blogPost ?? null;
    $selectedCategories = old('category_ids', $postModel ? $postModel->categories->pluck('id')->all() : []);
    $tagsValue = old('tags', $postModel ? implode(', ', $postModel->tags_list) : '');
@endphp

<div class="row">
    <div class="col-lg-8">
        <h5 class="mb-3">Post Content</h5>
        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $postModel->title ?? '') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                value="{{ old('slug', $postModel->slug ?? '') }}">
            <small class="text-muted">URL: /blog/<span id="slug-preview">{{ old('slug', $postModel->slug ?? 'your-slug') }}</span></small>
            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="excerpt" class="form-label">Excerpt</label>
            <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $postModel->excerpt ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control wysiwyg-editor" id="content" name="content" rows="12">{{ old('content', $postModel->content ?? '') }}</textarea>
        </div>

        <h6 class="mt-4">Categories</h6>
        <div class="mb-3 border rounded p-3">
            @forelse($categories ?? [] as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="cat_{{ $category->id }}"
                        {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                    <label class="form-check-label" for="cat_{{ $category->id }}">{{ $category->name }}</label>
                </div>
            @empty
                <p class="text-muted mb-0">No categories yet. <a href="{{ route('admin.blog-categories.create') }}" target="_blank">Create one</a></p>
            @endforelse
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{ $tagsValue }}" placeholder="Agency, Business, Digital">
            <small class="text-muted">Comma-separated tags</small>
        </div>

        <h6 class="mt-4">Author</h6>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="author_name" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="author_name" name="author_name" value="{{ old('author_name', $postModel->author_name ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="author_role" class="form-label">Author Role</label>
                <input type="text" class="form-control" id="author_role" name="author_role" value="{{ old('author_role', $postModel->author_role ?? '') }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="author_bio" class="form-label">Author Bio</label>
            <textarea class="form-control" id="author_bio" name="author_bio" rows="3">{{ old('author_bio', $postModel->author_bio ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-lg-4">
        <h5 class="mb-3">Publish</h5>
        <div class="mb-3">
            <label for="published_at" class="form-label">Publish Date</label>
            <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                value="{{ old('published_at', optional($postModel->published_at ?? null)->format('Y-m-d\TH:i')) }}">
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                    {{ old('status', $postModel->status ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Published</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="featured_image" class="form-label">Featured Image</label>
            <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
            @if(!empty($postModel->featured_image))
                <img src="{{ $postModel->imageUrl('featured_image') }}" alt="" class="img-thumbnail mt-2" style="max-height:120px;">
            @endif
        </div>

        <div class="mb-3">
            <label for="author_image" class="form-label">Author Image</label>
            <input type="file" class="form-control" id="author_image" name="author_image" accept="image/*">
            @if(!empty($postModel->author_image))
                <img src="{{ $postModel->imageUrl('author_image') }}" alt="" class="img-thumbnail mt-2" style="max-height:80px;">
            @endif
        </div>

        <hr>
        <h5 class="mb-3">SEO</h5>
        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $postModel->meta_title ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $postModel->meta_description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="2">{{ old('meta_keywords', $postModel->meta_keywords ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="og_title" class="form-label">OG Title</label>
            <input type="text" class="form-control" id="og_title" name="og_title" value="{{ old('og_title', $postModel->og_title ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="og_description" class="form-label">OG Description</label>
            <textarea class="form-control" id="og_description" name="og_description" rows="2">{{ old('og_description', $postModel->og_description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="og_image" class="form-label">OG Image URL</label>
            <input type="text" class="form-control" id="og_image" name="og_image" value="{{ old('og_image', $postModel->og_image ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="canonical_url" class="form-label">Canonical URL</label>
            <input type="url" class="form-control" id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $postModel->canonical_url ?? '') }}">
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const slugInput = document.getElementById('slug');
    const titleInput = document.getElementById('title');
    const slugPreview = document.getElementById('slug-preview');
    function updateSlugPreview() {
        if (slugPreview) {
            slugPreview.textContent = slugInput.value || (titleInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'your-slug');
        }
    }
    slugInput?.addEventListener('input', updateSlugPreview);
    titleInput?.addEventListener('input', updateSlugPreview);
    updateSlugPreview();
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.wysiwyg-editor',
            height: 400,
            menubar: false,
            plugins: 'lists link image code blockquote',
            toolbar: 'undo redo | bold italic | bullist numlist blockquote | link image | code',
        });
    }
})();
</script>
@endpush
