@extends('admin.layout')

@section('title', 'Create Blog Post')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Create Blog Post</h2>
    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card"><div class="card-body">
    <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.blog-posts._form', ['blogPost' => null, 'categories' => $categories])
        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-save"></i> Publish Post</button>
    </form>
</div></div>
@endsection
