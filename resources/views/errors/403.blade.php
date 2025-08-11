@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
    <h1>403 | Access Denied</h1>
    <p>You are not authorized to access this page.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
