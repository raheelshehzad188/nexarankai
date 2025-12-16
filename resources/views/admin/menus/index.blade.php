@extends('admin.layout')

@section('title', 'Menus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Menus</h2>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Menu
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Link Type</th>
                    <th>URL/Page</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>{{ $menu->title }}</td>
                    <td><span class="badge bg-info">{{ $menu->location }}</span></td>
                    <td>{{ $menu->link_type }}</td>
                    <td>{{ $menu->link_type === 'page' ? ($menu->page ? $menu->page->title : 'N/A') : $menu->url }}</td>
                    <td>{{ $menu->parent ? $menu->parent->title : '-' }}</td>
                    <td>
                        @if($menu->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
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
                    <td colspan="7" class="text-center">No menus found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

