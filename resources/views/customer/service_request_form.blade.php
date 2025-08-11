@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Request a Service</h2>

    <form action="{{ route('customer.service-requests.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="service_id" class="block text-sm font-medium">Select Service</label>
            <select name="service_id" id="service_id" required class="w-full p-2 border border-gray-300 rounded">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="details" class="block text-sm font-medium">Additional Details (Optional)</label>
            <textarea name="details" id="details" class="w-full p-2 border border-gray-300 rounded" rows="4"></textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit Request</button>
    </form>
</div>
@endsection
