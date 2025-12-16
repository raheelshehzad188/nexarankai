@extends('frontend.layout')

@section('title', 'Test Page')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="display-4 mb-4">Test Page</h1>
            <p class="lead">This is a test route page.</p>
            <div class="mt-4">
                <a href="/" class="btn btn-primary">Go to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection

