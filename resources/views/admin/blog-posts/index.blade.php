@extends('admin.layout')

@section('title', 'Blog Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Blog Posts</h2>
    <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Post
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Published</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->categories->pluck('name')->implode(', ') ?: '-' }}</td>
                    <td>{{ $post->published_at?->format('M d, Y') ?? '-' }}</td>
                    <td>
                        @if($post->status)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ $post->getUrl() }}" class="btn btn-sm btn-outline-primary" target="_blank"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">No blog posts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
