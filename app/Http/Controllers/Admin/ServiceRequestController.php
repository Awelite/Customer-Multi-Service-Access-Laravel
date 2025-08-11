<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestController extends Controller
{
    // Show all service requests
    /*public function index()
    {
        // Fetch all service requests with related user, service, and assigned staff
        $serviceRequests = ServiceRequest::with(['service', 'user', 'assignedStaff'])->latest()->get();

        // Get all users with role = 'staff' for dropdown
        $staff = User::where('role', 'staff')->get();

        return view('admin.service_requests.index', compact('serviceRequests', 'staff'));
    }*/

    public function index()
        {
            $serviceRequests = ServiceRequest::with(['customer', 'provider', 'service'])->latest()->get();

            return view('admin.service_requests.index', compact('serviceRequests'));
        }

    // Show the edit form for a specific service request
    public function edit($id)
    {
        $request = ServiceRequest::with(['user', 'service', 'assignedStaff'])->findOrFail($id);
        $staff = User::where('role', 'staff')->get();

        return view('admin.service_requests.edit', compact('request', 'staff'));
    }

    // Update status and optionally assign staff
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $sr = ServiceRequest::findOrFail($id);
        $sr->status = $validated['status'];
        $sr->assigned_to = $validated['assigned_to'] ?? null;
        $sr->save();

        return redirect()->route('admin.requests.index')->with('success', 'Service request updated successfully.');
    }

    // Assign staff separately if needed
    public function assignStaff(Request $request, $id)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $sr = ServiceRequest::findOrFail($id);
        $sr->assigned_to = $request->assigned_to;
        $sr->save();

        return redirect()->back()->with('success', 'Staff assigned successfully!');
    }
}
