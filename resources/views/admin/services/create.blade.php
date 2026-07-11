@extends('admin.layout')

@section('title', 'Create Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Create Service</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.services._form', ['service' => null, 'categories' => $categories])
            <button type="submit" class="btn btn-primary mt-3">
                <i class="bi bi-save"></i> Create Service
            </button>
        </form>
    </div>
</div>
@endsection
