<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceRequest;



class ProviderRequestController extends Controller
{
    public function index()
    {
        /*$providerId = auth()->id();

        $requests = ServiceRequest::where('provider_id', auth()->id())
            ->where('status', 'pending')
            ->with('customer')
            ->get();*/

       // $providerId = auth()->user()->id;//

        /*$requests = \App\Models\ServiceRequest::where('provider_id', $providerId)
        ->with('customer') // eager load customer relationship
        ->latest()
        ->get();*/
        $requests = ServiceRequest::with('customer', 'service')
                    ->where('provider_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();

                return view('provider.requests', compact('requests'));
            }
    

    public function accept($id)
        {
            /*$request = ServiceRequest::findOrFail($id);
            $request->update(['status' => 'accepted']);
              //  $serviceRequest->save();//
            // ✅ Notify customer
            $customerUser = $serviceRequest->customer;
            if ($customerUser) {
                $customerUser->notify(new RequestStatusUpdatedNotification($serviceRequest));
            }
            return back()->with('success', 'Request accepted.');
        }*/
        $serviceRequest = ServiceRequest::where('id', $id)
            ->where('provider_id', auth()->id())
            ->firstOrFail();

        $serviceRequest->status = 'accepted';
        $serviceRequest->save();
                return back()->with('success', 'Request accepted.');
        }

        public function reject($id)
        {
           /* $request = ServiceRequest::findOrFail($id);
            $request->update(['status' => 'rejected']);
            return back()->with('error', 'Request rejected.');
        }*/
            $serviceRequest = ServiceRequest::where('id', $id)
            ->where('provider_id', auth()->id())
            ->firstOrFail();

        $serviceRequest->status = 'rejected';
        $serviceRequest->save();

        return back()->with('success', 'Request rejected.');
    }

}
