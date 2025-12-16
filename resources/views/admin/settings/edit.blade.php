@extends('admin.layout')

@section('title', 'Site Settings')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Site Settings</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="site_logo" class="form-label">Site Logo</label>
                <input type="file" class="form-control" id="site_logo" name="site_logo">
                @if($settings->site_logo)
                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="mt-2" style="max-height: 100px;">
                @endif
            </div>

            <h6 class="mt-4">Header Settings</h6>
            <div class="mb-3">
                <label for="header_phone" class="form-label">Header Phone</label>
                <input type="text" class="form-control" id="header_phone" name="header_phone" value="{{ old('header_phone', $settings->header_phone) }}">
            </div>

            <div class="mb-3">
                <label for="header_email" class="form-label">Header Email</label>
                <input type="email" class="form-control" id="header_email" name="header_email" value="{{ old('header_email', $settings->header_email) }}">
            </div>

            <div class="mb-3">
                <label for="header_cta_text" class="form-label">Header CTA Text</label>
                <input type="text" class="form-control" id="header_cta_text" name="header_cta_text" value="{{ old('header_cta_text', $settings->header_cta_text) }}">
            </div>

            <div class="mb-3">
                <label for="header_cta_link" class="form-label">Header CTA Link</label>
                <input type="url" class="form-control" id="header_cta_link" name="header_cta_link" value="{{ old('header_cta_link', $settings->header_cta_link) }}">
            </div>

            <h6 class="mt-4">Footer Settings</h6>
            <div class="mb-3">
                <label for="footer_text" class="form-label">Footer Text</label>
                <textarea class="form-control" id="footer_text" name="footer_text" rows="4">{{ old('footer_text', $settings->footer_text) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>
    </div>
</div>
@endsection

