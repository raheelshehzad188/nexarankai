@extends('admin.layout')

@section('title', 'Edit Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Menu</h2>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $menu->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                <select class="form-select @error('location') is-invalid @enderror" id="location" name="location" required>
                    <option value="header" {{ old('location', $menu->location) == 'header' ? 'selected' : '' }}>Header</option>
                    <option value="footer" {{ old('location', $menu->location) == 'footer' ? 'selected' : '' }}>Footer</option>
                </select>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="link_type" class="form-label">Link Type <span class="text-danger">*</span></label>
                <select class="form-select @error('link_type') is-invalid @enderror" id="link_type" name="link_type" required>
                    <option value="page" {{ old('link_type', $menu->link_type) == 'page' ? 'selected' : '' }}>Page</option>
                    <option value="custom" {{ old('link_type', $menu->link_type) == 'custom' ? 'selected' : '' }}>Custom URL</option>
                </select>
                @error('link_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="page_id_field">
                <label for="page_id" class="form-label">Page</label>
                <select class="form-select @error('page_id') is-invalid @enderror" id="page_id" name="page_id">
                    <option value="">Select a page</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}" {{ old('page_id', $menu->page_id) == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                    @endforeach
                </select>
                @error('page_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="url_field" style="display: none;">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $menu->url) }}" placeholder="https://example.com">
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent Menu</label>
                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="">None (Top Level)</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $menu->sort_order) }}">
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $menu->status) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">
                        Active
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update Menu
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById('link_type').addEventListener('change', function() {
    const linkType = this.value;
    const pageField = document.getElementById('page_id_field');
    const urlField = document.getElementById('url_field');
    
    if (linkType === 'page') {
        pageField.style.display = 'block';
        urlField.style.display = 'none';
        document.getElementById('page_id').required = true;
        document.getElementById('url').required = false;
    } else {
        pageField.style.display = 'none';
        urlField.style.display = 'block';
        document.getElementById('page_id').required = false;
        document.getElementById('url').required = true;
    }
});

// Initialize on page load
document.getElementById('link_type').dispatchEvent(new Event('change'));
</script>
@endsection

