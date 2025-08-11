<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::where('user_id', auth()->id())
                                  ->with(['service', 'assignedStaff'])
                                  ->latest()
                                  ->get();

        return view('customer.requests.index', compact('requests'));
    }
}
