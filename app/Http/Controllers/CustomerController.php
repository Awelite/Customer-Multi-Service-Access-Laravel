<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.dashboard');
    }

    public function createRequest()
{
    $services = \App\Models\Service::all();
    return view('customer.service_request_form', compact('services'));
}

public function storeRequest(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'details' => 'nullable|string',
    ]);

    ServiceRequest::create([
        'user_id' => auth()->id(),
        'service_id' => $request->service_id,
        'details' => $request->details,
        'status' => 'pending',
    ]);

    return redirect()->route('customer.dashboard')->with('success', 'Service request submitted successfully!');
}

public function myRequests()
{
    $requests = ServiceRequest::where('user_id', auth()->id())->with('service')->latest()->get();
    //return view('customer.requests', compact('requests'));//
    return redirect()->route('customer.dashboard')->with('success', 'Service request submitted successfully!');

}


}
