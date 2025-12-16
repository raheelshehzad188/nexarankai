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

