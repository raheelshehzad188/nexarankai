@extends('admin.layout')

@section('title', 'Edit Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Service</h2>
    <div>
        <a href="{{ $service->getUrl() }}" class="btn btn-outline-primary" target="_blank">
            <i class="bi bi-eye"></i> View
        </a>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.services._form', ['service' => $service, 'categories' => $categories])
            <button type="submit" class="btn btn-primary mt-3">
                <i class="bi bi-save"></i> Update Service
            </button>
        </form>
    </div>
</div>
@endsection
