@extends('admin.layout')

@section('title', 'View Lead')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lead Details</h2>
    <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Leads
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-2"><strong>Name:</strong></div>
            <div class="col-md-10">{{ $lead->name }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Email:</strong></div>
            <div class="col-md-10"><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></div>
        </div>
        @if($lead->phone)
        <div class="row mb-3">
            <div class="col-md-2"><strong>Phone:</strong></div>
            <div class="col-md-10"><a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a></div>
        </div>
        @endif
        @if($lead->page)
        <div class="row mb-3">
            <div class="col-md-2"><strong>Page:</strong></div>
            <div class="col-md-10">{{ $lead->page }}</div>
        </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-2"><strong>Message:</strong></div>
            <div class="col-md-10">{{ $lead->message }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Submitted:</strong></div>
            <div class="col-md-10">{{ $lead->created_at->format('M d, Y H:i:s') }}</div>
        </div>
    </div>
</div>
@endsection

