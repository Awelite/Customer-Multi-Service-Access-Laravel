{{-- resources/views/customer/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <h2 class="fw-bold display-6 text-dark py-3">
                🏠 Customer Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-5 bg-light min-vh-100">
        <div class="container">
            {{-- Success Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Welcome Card --}}
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body">
                    <h4 class="card-title text-primary mb-3">
                        👋 Welcome!
                    </h4>
                    <p class="card-text text-muted">
                        You are logged in as a <strong>customer</strong>. Click below to view your submitted service requests.
                    </p>
                </div>
            </div>

            {{-- Button to My Requests --}}
            <div class="text-center">
                <a href="{{ route('customer.requests') }}" class="btn btn-outline-primary btn-lg px-5 py-2 shadow-sm">
                    📋 My Requests
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
