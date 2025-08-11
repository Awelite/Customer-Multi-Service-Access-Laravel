<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use App\Notifications\NewServiceRequestNotification;

class CustomerBookingController extends Controller
{
    public function search(Request $request)
    {
        $query = Provider::with('user')->where('status', 'approved');

        if ($request->filled('category')) {
            $query->where('category', 'LIKE', '%' . $request->category . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'LIKE', '%' . $request->city . '%');
        }

        $providers = $query->get();

        return view('customer.find_services', compact('providers'));
    }

    public function store(Request $request, $providerId)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // ✅ Save and assign to a variable
        $serviceRequest = ServiceRequest::create([
            'user_id' => auth()->id(), // customer
            'provider_id' => $providerId, // provider
            'service_id' => $request->service_id,
            'location' => $request->location,
            'description' => $request->description,
            'status' => 'pending',
            'reference_number' => 'SR-' . strtoupper(uniqid()),
        ]);

        // ✅ Notify the provider
        $providerUser = User::find($providerId);
        if ($providerUser && $serviceRequest) {
            $providerUser->notify(new NewServiceRequestNotification($serviceRequest));
        }

        return back()->with('success', 'Your service request has been sent.');
    }
}
