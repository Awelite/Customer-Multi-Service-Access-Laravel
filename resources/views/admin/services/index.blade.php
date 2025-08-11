@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">All Services</h2>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 text-right">
        <a href="{{ route('admin.services.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New Service</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Duration</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr class="text-center">
                        <td class="px-4 py-2 border">{{ $service->name }}</td>
                        <td class="px-4 py-2 border">{{ $service->description }}</td>
                        <td class="px-4 py-2 border">₹{{ number_format($service->price, 2) }}</td>
                        <td class="px-4 py-2 border">{{ $service->duration }} min</td>
                        <td class="px-4 py-2 border flex justify-center space-x-2">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">No services available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
