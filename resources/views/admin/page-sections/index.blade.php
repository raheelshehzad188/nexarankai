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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-3">
            <strong>Total Sections:</strong> {{ $sections->count() }}
            <span class="ms-3">
                <strong>Active:</strong> <span class="badge bg-success">{{ $sections->where('status', true)->count() }}</span>
                <strong class="ms-2">Inactive:</strong> <span class="badge bg-secondary">{{ $sections->where('status', false)->count() }}</span>
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                        <th>ID</th>
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
                        <td>{{ $section->id }}</td>
                        <td>
                            <strong>{{ $section->page ? $section->page->title : 'N/A' }}</strong>
                            @if($section->page)
                                <br><small class="text-muted">{{ $section->page->slug }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ str_replace('-', ' ', ucwords($section->type, '-')) }}</span>
                        </td>
                    <td>{{ $section->sort_order }}</td>
                    <td>
                        @if($section->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                        <td>
                            <small>{{ $section->created_at->format('M d, Y') }}</small>
                            <br><small class="text-muted">{{ $section->created_at->format('h:i A') }}</small>
                        </td>
                    <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.page-sections.edit', $section) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.page-sections.destroy', $section) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this section?')" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                            </div>
                    </td>
                </tr>
                @empty
                <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                <p class="mt-2">No page sections found.</p>
                                <a href="{{ route('admin.page-sections.create') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-plus-circle"></i> Create Your First Section
                                </a>
                            </div>
                        </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        @if($sections->count() > 0)
        <div class="mt-3">
            <div class="row">
                <div class="col-md-6">
                    <h6>Section Types Summary:</h6>
                    <ul class="list-unstyled">
                        @foreach($sections->groupBy('type') as $type => $typeSections)
                        <li>
                            <span class="badge bg-secondary">{{ str_replace('-', ' ', ucwords($type, '-')) }}</span>
                            <span class="text-muted">({{ $typeSections->count() }})</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Pages Summary:</h6>
                    <ul class="list-unstyled">
                        @foreach($sections->groupBy('page_id') as $pageId => $pageSections)
                        @php $page = $pageSections->first()->page; @endphp
                        @if($page)
                        <li>
                            <strong>{{ $page->title }}</strong>
                            <span class="text-muted">({{ $pageSections->count() }} sections)</span>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

