@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">📊 Admin Dashboard</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-primary border-4">
                <div class="card-body">
                    <h5 class="text-muted">Total Customers</h5>
                    <h3 class="fw-bold">{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <h5 class="text-muted">Total Providers</h5>
                    <h3 class="fw-bold">{{ $totalProviders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-info border-4">
                <div class="card-body">
                    <h5 class="text-muted">Total Services</h5>
                    <h3 class="fw-bold">{{ $totalServices }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <h5 class="text-muted">Total Requests</h5>
                    <h3 class="fw-bold">{{ $totalRequests }}</h3>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm bg-warning-subtle border-0">
                <div class="card-body text-center">
                    <h6 class="text-dark">Pending</h6>
                    <h4>{{ $pendingRequests }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm bg-success-subtle border-0">
                <div class="card-body text-center">
                    <h6 class="text-dark">Accepted</h6>
                    <h4>{{ $acceptedRequests }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm bg-danger-subtle border-0">
                <div class="card-body text-center">
                    <h6 class="text-dark">Rejected</h6>
                    <h4>{{ $rejectedRequests }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm bg-info-subtle border-0">
                <div class="card-body text-center">
                    <h6 class="text-dark">Completed</h6>
                    <h4>{{ $completedRequests }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
