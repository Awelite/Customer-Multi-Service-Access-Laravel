@extends('layouts.app')

@section('content')
<div class="card shadow p-4 text-center">
        @if(auth()->user()->provider && auth()->user()->provider->status === 'pending')
            <h4>⏳ Your application is under review</h4>
            <p>Please wait until the admin approves your provider account.</p>
        @elseif(auth()->user()->provider && auth()->user()->provider->status === 'approved')
            <h4>✅ Your application has been approved!</h4>
            <p>Welcome aboard! You can now access your provider dashboard.</p>
            <a href="{{ route('provider.dashboard') }}" class="btn btn-success mt-3">Go to Dashboard</a>
        @else
            <h4>❌ Unknown Status</h4>
            <p>Please contact support.</p>
        @endif
    </div>
</div>
@endsection
