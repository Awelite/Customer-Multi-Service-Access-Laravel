@extends('layouts.provider')

@section('content')
<div class="container">
    <h3 class="mb-4">📥 Incoming Service Requests</h3>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Request Cards --}}
    @forelse($requests as $request)
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">
                    🧰 Service: {{ $request->service->name ?? 'Unknown' }}
                </h5>
                <p><strong>📍 Location:</strong> {{ $request->location }}</p>
                <p><strong>🛠️ Issue:</strong> {{ $request->description }}</p>
                <p><strong>📌 Status:</strong> 
                    <span class="badge 
                        {{ $request->status === 'pending' ? 'bg-warning text-dark' : ($request->status === 'accepted' ? 'bg-success' : 'bg-secondary') }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </p>

                {{-- Customer Info (only if accepted) --}}
                @if($request->status === 'accepted')
                    <hr>
                    <h6 class="text-primary">👤 Customer Info</h6>
                    <p><strong>Name:</strong> {{ $request->customer->name ?? 'N/A' }}</p>
                    <p><strong>📞 Phone:</strong> {{ $request->customer->phone ?? 'N/A' }}</p>
                    <p><strong>🏠 Address:</strong> {{ $request->customer->address ?? 'N/A' }}</p>
                @endif

                {{-- Action Buttons --}}
                @if($request->status === 'pending')
                    <div class="d-flex gap-2 mt-3">
                        <form action="{{ route('provider.requests.accept', $request->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">✅ Accept</button>
                        </form>
                        <form action="{{ route('provider.requests.reject', $request->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">❌ Reject</button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    @empty
        <div class="alert alert-info">No service requests yet.</div>
    @endforelse
</div>
@endsection
