@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Header + New Request Button --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold text-primary">📋 My Service Requests</h2>
                <a href="{{ route('customer.service-requests.create') }}" class="btn btn-outline-primary">
                    + New Request
                </a>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Request Table --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 bg-light">
                    @if($requests->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Service Name</th>
                                        <th>Status</th>
                                        <th>Assigned Staff</th>
                                        <th>Date Requested</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td class="text-muted">{{ $request->reference_number ?? '—' }}</td>
                                            <td class="fw-semibold">{{ $request->service->name ?? 'N/A' }}</td>
                                            <td>
                                                @php
                                                    $statusClass = match($request->status) {
                                                        'Pending' => 'bg-warning text-dark',
                                                        'Approved' => 'bg-success',
                                                        'Rejected' => 'bg-danger',
                                                        default => 'bg-secondary'
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }}">
                                                    {{ $request->status }}
                                                </span>
                                            </td>
                                            <td>{{ $request->assignedStaff->name ?? '— Not Assigned' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($request->created_at)->format('d M Y') }}</td>
                                            <td>{{ $request->note ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center mb-0">
                            You haven’t submitted any requests yet.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
