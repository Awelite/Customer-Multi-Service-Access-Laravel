@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">My Service Requests</h1>

    @if ($requests->isEmpty())
        <p>No service requests found.</p>
    @else
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Service</th>
                    <th class="p-2 border">Details</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Requested At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $req)
                    <tr>
                        <td class="p-2 border">{{ $req->service->name }}</td>
                        <td class="p-2 border">{{ $req->details }}</td>
                        <td class="p-2 border capitalize">{{ $req->status }}</td>
                        <td class="p-2 border">{{ $req->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
