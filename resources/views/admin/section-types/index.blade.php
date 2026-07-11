@extends('admin.layout')

@section('title', 'Section Types')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Section Types</h2>
    <a href="{{ route('admin.section-types.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Section Type
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @forelse($sectionTypes as $sectionType)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($sectionType->image)
                        @php
                            $imagePath = \Illuminate\Support\Str::startsWith($sectionType->image, 'uploads/')
                                ? $sectionType->image
                                : 'uploads/' . ltrim($sectionType->image, '/');
                        @endphp
                        <img src="{{ asset($imagePath) }}" class="card-img-top" alt="{{ $sectionType->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $sectionType->name }}</h5>
                        <p class="card-text">
                            <small class="text-muted">Slug: <code>{{ $sectionType->slug }}</code></small>
                        </p>
                        @if($sectionType->description)
                            <p class="card-text">{{ Str::limit($sectionType->description, 100) }}</p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($sectionType->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                                <span class="badge bg-info ms-1">Order: {{ $sectionType->sort_order }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('admin.section-types.edit', $sectionType) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.section-types.destroy', $sectionType) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this section type?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No section types found.</p>
                    <a href="{{ route('admin.section-types.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Create Your First Section Type
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

