@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Pages</h5>
                <h2>{{ \App\Models\Page::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Services</h5>
                <h2>{{ \App\Models\Service::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Testimonials</h5>
                <h2>{{ \App\Models\Testimonial::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Leads</h5>
                <h2>{{ \App\Models\Lead::count() }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Leads</h5>
                <a href="{{ route('admin.leads.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @php
                    $recentLeads = \App\Models\Lead::orderBy('created_at', 'desc')->take(5)->get();
                @endphp
                @if($recentLeads->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Submitted</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentLeads as $lead)
                                <tr>
                                    <td><strong>{{ $lead->name }}</strong></td>
                                    <td><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></td>
                                    <td>{{ $lead->phone ?? '-' }}</td>
                                    <td><small>{{ $lead->created_at->diffForHumans() }}</small></td>
                                    <td>
                                        <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No leads yet. Form submissions will appear here.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Stats</h5>
            </div>
            <div class="card-body">
                @php
                    $todayLeads = \App\Models\Lead::whereDate('created_at', today())->count();
                    $thisWeekLeads = \App\Models\Lead::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
                    $thisMonthLeads = \App\Models\Lead::whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->count();
                @endphp
                <div class="mb-3">
                    <strong>Today:</strong>
                    <span class="badge bg-primary ms-2">{{ $todayLeads }} Leads</span>
                </div>
                <div class="mb-3">
                    <strong>This Week:</strong>
                    <span class="badge bg-info ms-2">{{ $thisWeekLeads }} Leads</span>
                </div>
                <div class="mb-3">
                    <strong>This Month:</strong>
                    <span class="badge bg-success ms-2">{{ $thisMonthLeads }} Leads</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Welcome to CMS Admin Panel</h5>
            </div>
            <div class="card-body">
                <p>Use the sidebar to manage your content.</p>
            </div>
        </div>
    </div>
</div>
@endsection

