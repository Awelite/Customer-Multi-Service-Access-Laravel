@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-20 text-center">
    <h2 class="text-2xl font-bold mb-6">Register As</h2>
    
    <div class="flex justify-center space-x-8">
        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">Customer</a>
        <a href="{{ route('provider.register') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">Provider</a>
    </div>
</div>
@endsection
