@extends('layouts.app')

@section('content')

{{-- Safe check for logged-in user --}}
@auth
    <div>{{ Auth::user()->name }}</div>
@else
    <div>Guest</div> {{-- Or leave empty --}}
@endauth


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0 text-center">Service Provider Registration</h4>
                </div>
                <div class="card-body px-5 py-4">
                    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

                        <form action="{{ route('provider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                        <h5 class="mb-3">Personal Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">-- Select Gender --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Experience (in years)</label>
                                <input type="number" name="experience" class="form-control" min="0" required>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Address & Category</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Category of Service</label>
                                    <input type="text" name="category" class="form-control" placeholder="e.g., Electrician, Plumber" required>
                                </div>
                                <div class="col-md-3">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Postal Address</label>
                                    <input type="text" name="postal_address" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Location</label>
                                    <input type="text" name="location" class="form-control" placeholder="Nearby landmark or area">
                                </div>
                                <div class="col-md-4">
                                    <label>Full Address</label>
                                    <textarea name="full_address" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                            
                        </div>

                        <h5 class="mt-4 mb-3">Upload Documents</h5>
                        <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" required>
                        </div>
                        <div class="col-md-4">
                            <label>ID Proof (PDF or Image)</label>
                            <input type="file" name="id_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>
                    
                    </div>


                        <div class="mb-4">
                            <label>Request Message to Admin</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Why do you want to join?" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">
                                Submit Registration
                            </button>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
