<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceRequest;

class ServiceController extends Controller
{



    public function updateStatus(Request $request, $id)
    {
    $request->validate([
        'status' => 'required|in:approved,rejected',
    ]);

    $serviceRequest = ServiceRequest::findOrFail($id);
    $serviceRequest->status = $request->status;
    $serviceRequest->save();

    return redirect()->route('admin.service-requests.index')->with('success', 'Status updated successfully!');
    }


    // Display all services
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    // Show form to create a new service
    public function create()
    {
        return view('admin.services.create');
    }

    // Store a new service in the database
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:1',
        ]);

        // Save to database
        Service::create($validatedData);

        // Redirect to the service list with a success message
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    // Show form to edit an existing service
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Update an existing service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:1',
        ]);

        $service->update($request->only(['name', 'description', 'price', 'duration']));

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    // Delete a service
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
