@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold">📋 My Service Requests</h2>

    @if($requests->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Assigned Staff</th>
                        <th>Requested On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->service->name }}</td>
                        <td>
                            @if($request->status == 'Pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($request->status == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($request->status == 'Rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-secondary">{{ $request->status }}</span>
                            @endif
                        </td>
                        <td>{{ $request->assignedStaff->name ?? '— Not Assigned' }}</td>
                        <td>{{ $request->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">You haven’t submitted any service requests yet.</div>
    @endif
</div>
@endsection
