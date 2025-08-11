@extends('layouts.admin')

@section('content')
<div class="card shadow-sm p-4 bg-white rounded">
    <h3 class="mb-4 text-center text-dark">Provider Details</h3>

    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Name:</strong>
            <div>{{ $provider->user->name ?? 'No Name Provided' }}</div>
        </div>
        <div class="col-md-6">
            <strong>Email:</strong>
            <div>{{ $provider->user->email }}</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>Category:</strong>
            <div>{{ $provider->category }}</div>
        </div>
        <div class="col-md-4">
            <strong>Gender:</strong>
            <div>{{ ucfirst($provider->gender) }}</div>
        </div>
        <div class="col-md-4">
            <strong>Date of Birth:</strong>
            <div>{{ $provider->dob }}</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>Phone:</strong>
            <div>{{ $provider->phone }}</div>
        </div>
        <div class="col-md-4">
            <strong>Experience:</strong>
            <div>{{ $provider->experience }} years</div>
        </div>
        <div class="col-md-4">
            <strong>Status:</strong>
            <span class="badge {{ $provider->status == 'Approved' ? 'bg-success' : ($provider->status == 'Pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                {{ $provider->status }}
            </span>
        </div>
    </div>

    <div class="mb-3">
        <strong>Message to Admin:</strong>
        <div>{{ $provider->message ?? 'None' }}</div>
    </div>

    <div class="mb-3">
        <strong>Full Address:</strong>
        <div>{{ $provider->full_address }}</div>
    </div>

    <div class="mb-3">
        <strong>Postal Address:</strong>
        <div>{{ $provider->postal_address }}</div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 text-center">
            <h6 class="text-dark">Profile Photo</h6>
            @if($provider->photo)
                <img src="{{ asset('storage/' . $provider->photo) }}" class="img-thumbnail" width="150">
            @else
                <p>No Photo Provided</p>
            @endif
        </div>

        <div class="col-md-4 text-center">
            <h6 class="text-dark">ID Proof</h6>
            @if($provider->id_proof)
                <a href="{{ asset('storage/' . $provider->id_proof) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Document</a>
            @else
                <p>No ID Proof Uploaded</p>
            @endif
        </div>

        <div class="col-md-4 text-center">
            <h6 class="text-dark">Experience Certificate</h6>
            @if($provider->experience_certificate)
                <a href="{{ asset('storage/' . $provider->experience_certificate) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Certificate</a>
            @else
                <p>No Certificate Uploaded</p>
            @endif
        </div>
    </div>

    <div class="d-flex gap-3 mt-4">
        <form method="POST" action="{{ route('admin.providers.approve', $provider->id) }}">
            @csrf
            <button class="btn btn-success">Approve</button>
        </form>
        <form method="POST" action="{{ route('admin.providers.decline', $provider->id) }}">
            @csrf
            <button class="btn btn-danger">Decline</button>
        </form>
        <a href="{{ route('admin.providers.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
