@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4 text-primary">🔧 Manage Service Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($serviceRequests->count())
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Service</th>
                            <th>Requested By</th>
                            <th>Status</th>
                            <th>Assigned Staff</th>
                            <th>Update Request</th>
                            <th>Requested On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($serviceRequests as $request)
                        <tr>
                            <td>{{ $request->service->name }}</td>
                            <td>{{ $request->user->name ?? 'N/A' }}</td>
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
                            <td>
                                {{ $request->assignedStaff->name ?? '— Not Assigned' }}
                            </td>
                            <td>
                                <form action="{{ route('admin.requests.update', $request->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-1">
                                        <select name="staff_id" class="form-select form-select-sm">
                                            <option value="">-- Assign Staff --</option>
                                            {{--@foreach($staff as $member)
                                                <option value="{{ $member->id }}" {{ $request->assigned_to == $member->id ? 'selected' : '' }}>
                                                    {{ $member->name }}
                                                </option>
                                            @endforeach--}}
                                        </select>
                                    </div>

                                    <div class="mb-1">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approved" {{ $request->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="Rejected" {{ $request->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>

                                    <button class="btn btn-primary btn-sm w-100" type="submit">
                                        <i class="bi bi-arrow-repeat"></i> Update
                                    </button>
                                </form>
                            </td>
                            <td>{{ $request->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.requests.edit', $request->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No service requests found.</div>
            @endif
        </div>
    </div>
</div>
@endsection
