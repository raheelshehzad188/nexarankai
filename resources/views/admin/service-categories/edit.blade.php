@extends('admin.layout')

@section('title', 'Edit Service Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Service Category</h2>
    <a href="{{ route('admin.service-categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.service-categories.update', $serviceCategory) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.service-categories._form')
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update Category
            </button>
        </form>
    </div>
</div>
@endsection
