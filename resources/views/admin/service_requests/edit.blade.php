{{-- resources/views/admin/service_requests/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    ✏️ Edit Service Request
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.service_requests.update', $request->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Service Name (read-only) --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Service</label>
                            <input type="text" class="form-control" value="{{ $request->service->name }}" readonly>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ $request->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ $request->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        {{-- Assign Staff --}}
                        <div class="mb-3">
                            <label for="staff_id" class="form-label fw-semibold">Assign to Staff</label>
                            <select name="staff_id" id="staff_id" class="form-select">
                                <option value="">-- Select Staff --</option>
                                @foreach($staff as $user)
                                    <option value="{{ $user->id }}" {{ $request->staff_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Note (optional, read-only) --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Customer Note</label>
                            <textarea class="form-control" rows="3" readonly>{{ $request->note }}</textarea>
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.service_requests.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-success">✅ Update Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
