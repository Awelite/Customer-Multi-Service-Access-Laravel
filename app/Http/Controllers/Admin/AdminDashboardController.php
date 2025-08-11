<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = User::where('role', 'customer')->count();
        $totalProviders = User::where('role', 'provider')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalServices = Service::count();
        $totalRequests = ServiceRequest::count();

        $pendingRequests = ServiceRequest::where('status', 'pending')->count();
        $acceptedRequests = ServiceRequest::where('status', 'accepted')->count();
        $rejectedRequests = ServiceRequest::where('status', 'rejected')->count();
        $completedRequests = ServiceRequest::where('status', 'completed')->count();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalProviders',
            'totalStaff',
            'totalServices',
            'totalRequests',
            'pendingRequests',
            'acceptedRequests',
            'rejectedRequests',
            'completedRequests'
        ));
    }

    /*public function customersList()
    {
        $customers = User::where('role', 'customer')->latest()->get();
        return view('admin.customers.index', compact('customers'));
        
    }*/

        public function customersList(Request $request)
        {
            $query = User::where('role', 'customer');

            // Optional search filters
            if ($request->filled('search')) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            }

            $customers = $query->latest()->paginate(10);

            return view('admin.customers.index', compact('customers'));
        }

        public function viewCustomer($id)
        {
            $customer = User::with(['serviceRequests' => function($q) {
                $q->latest();
            }])->findOrFail($id);

            return view('admin.customers.view', compact('customer'));
        }

    public function providersList()
    {
        $providers = User::where('role', 'provider')->with('provider')->latest()->get();
        return view('admin.providers.index', compact('providers'));
    }

    public function serviceRequests()
    {
        $requests = ServiceRequest::with(['user', 'provider'])->latest()->get();
        return view('admin.requests.index', compact('requests'));
    }
}
