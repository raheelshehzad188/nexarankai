@extends('admin.layout')

@section('title', 'Create Blog Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Create Blog Category</h2>
    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card"><div class="card-body">
    <form action="{{ route('admin.blog-categories.store') }}" method="POST">
        @csrf
        @include('admin.blog-categories._form', ['blogCategory' => null])
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Create Category</button>
    </form>
</div></div>
@endsection
