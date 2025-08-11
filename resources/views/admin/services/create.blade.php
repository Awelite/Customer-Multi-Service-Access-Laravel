@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow-md rounded-lg mt-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Create New Service</h2>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-md">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf

        {{-- Service Name --}}
        <div class="mb-5">
            <label for="name" class="block text-gray-700 font-medium mb-2">Service Name</label>
            <input type="text" name="name" id="name"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('name') }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-5">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      required>{{ old('description') }}</textarea>
        </div>

        {{-- Price --}}
        <div class="mb-5">
            <label for="price" class="block text-gray-700 font-medium mb-2">Price (₹)</label>
            <input type="number" name="price" id="price" step="0.01"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('price') }}" required>
        </div>

        {{-- Duration --}}
        <div class="mb-5">
            <label for="duration" class="block text-gray-700 font-medium mb-2">Duration (minutes)</label>
            <input type="number" name="duration" id="duration" min="1"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('duration') }}" required>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end">
            <a href="{{ route('admin.services.index') }}"
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md mr-3 hover:bg-gray-300 transition">Cancel</a>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">Create Service</button>
        </div>
    </form>
</div>
@endsection
