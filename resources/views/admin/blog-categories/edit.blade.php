@extends('admin.layout')

@section('title', 'Edit Blog Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Edit Blog Category</h2>
    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card"><div class="card-body">
    <form action="{{ route('admin.blog-categories.update', $blogCategory) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.blog-categories._form')
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Category</button>
    </form>
</div></div>
@endsection
