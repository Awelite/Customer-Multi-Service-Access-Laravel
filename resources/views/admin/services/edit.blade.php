@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow-md rounded-lg mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Service</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Service Name</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('name', $service->name) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
            <input type="number" name="price" id="price" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('price', $service->price) }}" required>
        </div>

        <div class="mb-4">
            <label for="duration" class="block text-gray-700 font-medium mb-2">Duration (in minutes)</label>
            <input type="number" name="duration" id="duration" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('duration', $service->duration) }}" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.services.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md mr-2">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
