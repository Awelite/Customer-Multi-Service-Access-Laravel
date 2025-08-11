@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-center">🔍 Find a Service Provider</h3>

    {{-- Search Form --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <form method="GET" action="{{ route('customer.find.services') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="category" class="form-control" placeholder="Service type (e.g. plumber)" value="{{ request('category') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="city" class="form-control" placeholder="City" value="{{ request('city') }}">
                </div>
                <div class="col-md-4 d-grid">
                    <button type="submit" class="btn btn-primary">🔍 Search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- No Result --}}
    @if($providers->isEmpty())
        <div class="alert alert-warning text-center">No providers found for your search.</div>
    @endif

    @php
        $services = App\Models\Service::all();
    @endphp

    {{-- Provider Cards --}}
    <div class="row">
        @foreach($providers as $provider)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/' . $provider->photo) }}" class="rounded-circle me-3" width="60" height="60" alt="Photo">
                        <div>
                            <h5 class="mb-0">{{ $provider->user->name }}</h5>
                            <small class="text-muted">{{ $provider->category }} | {{ $provider->experience }} yrs</small>
                            @if($provider->average_rating)
                                <div class="text-warning">⭐ {{ $provider->average_rating }}/5</div>
                            @endif
                        </div>
                    </div>

                    <ul class="list-unstyled mb-3">
                        <li><strong>📍 City:</strong> {{ $provider->city }}</li>
                        <li><strong>📞 Phone:</strong> {{ $provider->user->phone ?? 'N/A' }}</li>
                        <li><strong>✉️ Email:</strong> {{ $provider->user->email ?? 'N/A' }}</li>
                    </ul>

                    <div class="d-grid">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#requestModal{{ $provider->id }}">
                            📨 Request Service
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="requestModal{{ $provider->id }}" tabindex="-1" aria-labelledby="requestModalLabel{{ $provider->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('customer.request.service', $provider->user_id) }}" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestModalLabel{{ $provider->id }}">📨 Request Service from {{ $provider->user->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select Service</label>
                            <select name="service_id" class="form-select" required>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ $service->name == $provider->category ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Your Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Enter your location" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Problem Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Briefly describe your issue..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
