@extends('admin.layout')

@section('title', 'Create Client Logo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Create New Client Logo</h2>
    <a href="{{ route('admin.client-logos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.client-logos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Logo Source <span class="text-danger">*</span></label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="logo_source" id="logo_source_upload" value="upload" checked onchange="toggleLogoSource()">
                    <label class="btn btn-outline-primary" for="logo_source_upload">Upload Image</label>
                    
                    <input type="radio" class="btn-check" name="logo_source" id="logo_source_url" value="url" onchange="toggleLogoSource()">
                    <label class="btn btn-outline-primary" for="logo_source_url">Image URL</label>
                </div>
            </div>

            <div class="mb-3" id="logo_upload_section">
                <label for="logo" class="form-label">Upload Logo <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                <small class="form-text text-muted">Supported formats: JPG, PNG, GIF, SVG (Max size: 2MB)</small>
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="logo_url_section" style="display: none;">
                <label for="logo_url" class="form-label">Logo URL <span class="text-danger">*</span></label>
                <input type="url" class="form-control @error('logo_url') is-invalid @enderror" id="logo_url" name="logo_url" value="{{ old('logo_url') }}" placeholder="https://example.com/logo.png">
                <small class="form-text text-muted">Enter direct URL to logo image (e.g., CDN link)</small>
                @error('logo_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Website URL</label>
                <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="https://example.com">
                @error('website')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Create Client Logo
            </button>
        </form>
    </div>
</div>

<script>
function toggleLogoSource() {
    const uploadRadio = document.getElementById('logo_source_upload');
    const urlRadio = document.getElementById('logo_source_url');
    const uploadSection = document.getElementById('logo_upload_section');
    const urlSection = document.getElementById('logo_url_section');
    const logoInput = document.getElementById('logo');
    const logoUrlInput = document.getElementById('logo_url');

    if (uploadRadio.checked) {
        uploadSection.style.display = 'block';
        urlSection.style.display = 'none';
        logoInput.required = true;
        logoUrlInput.required = false;
        logoUrlInput.value = '';
    } else {
        uploadSection.style.display = 'none';
        urlSection.style.display = 'block';
        logoInput.required = false;
        logoUrlInput.required = true;
        logoInput.value = '';
    }
}
</script>
@endsection

