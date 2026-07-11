@extends('admin.layout')

@section('title', 'Leads')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Leads</h2>
    <span class="badge bg-primary">{{ $leads->count() }} Total Leads</span>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        @if($leads->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                            <th>Page</th>
                            <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                        @foreach($leads as $lead)
                <tr>
                            <td><strong>{{ $lead->name }}</strong></td>
                            <td><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></td>
                            <td>
                                @if($lead->phone)
                                    <a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($lead->message, 50) }}</td>
                            <td>
                                @if($lead->page)
                                    <small class="text-muted">{{ parse_url($lead->page, PHP_URL_PATH) }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $lead->created_at->format('M d, Y') }}</small><br>
                                <small class="text-muted">{{ $lead->created_at->format('H:i') }}</small>
                            </td>
                    <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-sm btn-info" title="View Details">
                                        <i class="bi bi-eye"></i>
                        </a>
                                    <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                            @csrf
                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                                </div>
                    </td>
                </tr>
                        @endforeach
            </tbody>
        </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="bi bi-inbox"></i> No leads found. Form submissions will appear here.
            </div>
        @endif
    </div>
</div>
@endsection

