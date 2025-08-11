<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\Service;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
    return view('admin.dashboard'); // or customer.dashboard / staff.dashboard
}




/*public function viewServiceRequests()
{
    $requests = ServiceRequest::with(['user', 'service'])->latest()->get();
    return view('admin.service_requests.index', compact('requests'));
}*/



public function viewServiceRequests()
{
    $serviceRequests = ServiceRequest::with('user', 'service')->get();
    return view('admin.service_requests.index', compact('serviceRequests'));
}

public function updateServiceRequest(Request $request, $id)
{
    $serviceRequest = ServiceRequest::findOrFail($id);
    $serviceRequest->status = $request->status;
    $serviceRequest->save();

    return redirect()->route('admin.service_requests.index')->with('success', 'Request updated!');
}


}
