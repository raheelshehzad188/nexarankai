@extends('frontend.layout')

@section('title', 'Home')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4">Welcome to CMS</h1>
            <p class="lead">Content Management System is ready! Create pages from admin panel to get started.</p>
        </div>
    </div>

    @if(isset($pages) && $pages->count() > 0)
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Available Pages</h2>
                <div class="row">
                    @foreach($pages as $p)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $p->title }}</h5>
                                    <a href="/{{ $p->slug }}" class="btn btn-primary">
                                        View Page <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h4>No pages created yet!</h4>
                    <p>Please create a "Home" page from the admin panel to get started.</p>
                    <a href="/admin/login" class="btn btn-primary mt-3">
                        Go to Admin Panel
                    </a>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quick Start Guide</h5>
                    <ol class="text-start" style="display: inline-block;">
                        <li>Login to Admin Panel: <a href="/admin/login">/admin/login</a></li>
                        <li>Create a "Home" page with slug "home"</li>
                        <li>Add sections to your page (Hero, Content, Services, etc.)</li>
                        <li>Publish the page and see it here!</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

