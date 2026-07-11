@extends('admin.layout')

@section('title', 'Edit Page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Page</h2>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $page->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" required>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}">
                @error('meta_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                <small class="form-text text-muted">Recommended: 150-160 characters for best SEO results</small>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" rows="2">{{ old('meta_keywords', $page->meta_keywords) }}</textarea>
                <small class="form-text text-muted">Enter keywords separated by commas (e.g., ac cleaning, duct cleaning, dubai)</small>
                @error('meta_keywords')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <h6 class="mt-4 mb-2">Service Schema (for service pages)</h6>
            <p class="text-muted small">Enable Service schema for this page. URL & description come from page data.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="schema_type" class="form-label">Schema Type</label>
                        <select class="form-select" id="schema_type" name="schema_type">
                            <option value="">WebPage (default)</option>
                            <option value="service" {{ old('schema_type', $page->schema_type ?? '') == 'service' ? 'selected' : '' }}>Service</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="schema_service_type" class="form-label">Service Type</label>
                        <input type="text" class="form-control" id="schema_service_type" name="schema_service_type" value="{{ old('schema_service_type', $page->schema_service_type ?? '') }}" placeholder="e.g. Air Duct Cleaning">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="schema_area_locality" class="form-label">Area (City)</label>
                        <input type="text" class="form-control" id="schema_area_locality" name="schema_area_locality" value="{{ old('schema_area_locality', $page->schema_area_locality ?? 'Dubai') }}" placeholder="e.g. Dubai">
                    </div>
                    <div class="mb-3">
                        <label for="schema_area_country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="schema_area_country" name="schema_area_country" value="{{ old('schema_area_country', $page->schema_area_country ?? 'UAE') }}" placeholder="e.g. UAE">
                    </div>
                </div>
            </div>

            <h6 class="mt-4 mb-2">Schema (Service / LocalBusiness)</h6>
            <p class="text-muted small">For service pages, use Service schema. Set schema type to "Service" and fill service type & area.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="schema_type" class="form-label">Schema Type</label>
                        <select class="form-select" id="schema_type" name="schema_type">
                            <option value="">Default (WebPage)</option>
                            <option value="service" {{ old('schema_type', $page->schema_type) == 'service' ? 'selected' : '' }}>Service</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="schema_service_type" class="form-label">Service Type</label>
                        <input type="text" class="form-control" id="schema_service_type" name="schema_service_type" value="{{ old('schema_service_type', $page->schema_service_type) }}" placeholder="e.g. Air Duct Cleaning, AC Coil Cleaning">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="schema_area_locality" class="form-label">Area (City)</label>
                        <input type="text" class="form-control" id="schema_area_locality" name="schema_area_locality" value="{{ old('schema_area_locality', $page->schema_area_locality) }}" placeholder="e.g. Dubai">
                    </div>
                    <div class="mb-3">
                        <label for="schema_area_country" class="form-label">Area (Country)</label>
                        <input type="text" class="form-control" id="schema_area_country" name="schema_area_country" value="{{ old('schema_area_country', $page->schema_area_country) }}" placeholder="e.g. UAE">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="use_irhas_layout" name="use_irhas_layout" value="1"
                        {{ old('use_irhas_layout', $page->use_irhas_layout ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="use_irhas_layout">
                        Use Irhas Layout (Home 3)
                    </label>
                </div>
                <small class="form-text text-muted">Enable Irhas Home 3 theme layout with its header/footer and section styles.</small>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="use_new_layout" name="use_new_layout" value="1"
                        {{ old('use_new_layout', $page->use_new_layout ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="use_new_layout">
                        Use New Layout
                    </label>
                </div>
                <small class="form-text text-muted">Enable alternate full-page design (no default site header/footer). Use with "new-full" section type.</small>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="draft" {{ old('status', $page->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $page->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update Page
            </button>
        </form>
    </div>
</div>
@endsection

