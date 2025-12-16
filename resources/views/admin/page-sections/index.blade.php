@extends('admin.layout')

@section('title', 'Page Sections')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Page Sections</h2>
    <a href="{{ route('admin.page-sections.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Section
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Type</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sections as $section)
                <tr>
                    <td>{{ $section->page ? $section->page->title : 'N/A' }}</td>
                    <td><span class="badge bg-info">{{ $section->type }}</span></td>
                    <td>{{ $section->sort_order }}</td>
                    <td>
                        @if($section->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $section->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.page-sections.edit', $section) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.page-sections.destroy', $section) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No page sections found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

