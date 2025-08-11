@extends('layouts.admin')

@section('content')
<div class="card shadow-sm p-4 bg-white rounded">
    <h3 class="mb-4 text-center text-dark">All Registered Providers</h3>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Provider Name</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Registered On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($providers as $provider)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $provider->user->name ?? 'N/A' }}</td>
                    <td>{{ $provider->user->email }}</td>
                    <td>{{ $provider->category }}</td>
                    <td>
                        <span class="badge {{ $provider->status == 'Approved' ? 'bg-success' : ($provider->status == 'Pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                            {{ $provider->status }}
                        </span>
                    </td>
                    <td>{{ $provider->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.providers.show', $provider->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted">No providers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
