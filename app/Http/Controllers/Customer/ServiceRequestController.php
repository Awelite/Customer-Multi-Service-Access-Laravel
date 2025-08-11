<?php

/*namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function index()
    {
        // Get all service requests created by the currently logged-in customer
        $requests = ServiceRequest::where('user_id', auth()->id())->get();

        // Pass them to the view
        return view('customer.requests.index', compact('requests'));
    }
}*/
/*
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'user_id', 'assigned_to', 'service_id', 'status', 'reference_number', 'staff_id'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
*/



namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestController extends Controller
{
    public function index()
    {
        // Get all service requests created by the currently logged-in customer
        $requests = ServiceRequest::where('user_id', auth()->id())->get();
        return view('customer.requests.index', compact('requests'));
    }

    public function store(Request $request, $providerId)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ServiceRequest::create([
            'user_id' => auth()->id(),
            'provider_id' => $providerId, // ✅ FIXED
            'service_id' => $request->service_id,
            'location' => $request->location,
            'description' => $request->description,
            'status' => 'pending',
        ]);

    return back()->with('success', '✅ Service request sent successfully!');    }
}
