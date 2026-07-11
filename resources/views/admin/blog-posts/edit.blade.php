@extends('admin.layout')

@section('title', 'Edit Blog Post')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Blog Post</h2>
    <div>
        <a href="{{ $blogPost->getUrl() }}" class="btn btn-outline-primary" target="_blank"><i class="bi bi-eye"></i> View</a>
        <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
    </div>
</div>
<div class="card"><div class="card-body">
    <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.blog-posts._form', ['blogPost' => $blogPost, 'categories' => $categories])
        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-save"></i> Update Post</button>
    </form>
</div></div>
@endsection
