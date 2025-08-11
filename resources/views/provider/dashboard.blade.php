@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">My Profile</h2>

    <div class="card shadow rounded-4 p-4 bg-white">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($user->provider && $user->provider->photo)
                    <img src="{{ asset('storage/' . $user->provider->photo) }}" class="rounded-circle" width="150" height="150" alt="Photo">
                @else
                    <img src="{{ asset('default-avatar.png') }}" class="rounded-circle" width="150" height="150" alt="Default Avatar">
                @endif
            </div>

            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th>Full Name:</th>
                        <td>{{ $user->provider->full_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{ $user->provider->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td>{{ ucfirst($user->provider->gender ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>DOB:</th>
                        <td>{{ $user->provider->dob ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge {{ $user->provider->status === 'approved' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($user->provider->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
