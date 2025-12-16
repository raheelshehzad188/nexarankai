@extends('admin.layout')

@section('title', 'Client Logos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Client Logos</h2>
    <a href="{{ route('admin.client-logos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Client Logo
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>
                        @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" style="max-height: 50px;">
                        @else
                            <span class="text-muted">No logo</span>
                        @endif
                    </td>
                    <td>
                        @if($client->website)
                            <a href="{{ $client->website }}" target="_blank">{{ $client->website }}</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $client->sort_order ?? '-' }}</td>
                    <td>
                        @if($client->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.client-logos.edit', $client) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.client-logos.destroy', $client) }}" method="POST" class="d-inline">
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
                    <td colspan="6" class="text-center">No client logos found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

