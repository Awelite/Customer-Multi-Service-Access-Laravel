<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceRequest;


class ProviderController extends Controller
{
    // Show Provider Registration Form
    public function showRegisterForm()
    {
        return view('provider.register');
    }

    // Handle Provider Registration Submission
    public function store(Request $request)
    {
        // 1. Validate
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'experience' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'full_address' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'proof_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'message' => 'nullable|string|max:500',
        ]);

        // 2. Handle file uploads
        $photoPath = $request->hasFile('photo') ? $request->file('photo')->store('provider_photos', 'public') : null;
        $proofDocumentPath = $request->hasFile('proof_document') ? $request->file('proof_document')->store('provider_id_proofs', 'public') : null;

        // 3. Create provider profile
        $provider = new Provider();
        $provider->user_id = auth()->id(); // ✅ Associate with currently logged-in user
        $provider->phone = $validated['phone'];
        $provider->dob = $validated['dob'];
        $provider->gender = $validated['gender'];
        $provider->experience = $validated['experience'];
        $provider->category = $validated['category'];
        $provider->city = $validated['city'];
        $provider->state = $validated['state'];
        $provider->full_address = $validated['full_address'];
        $provider->postal_address = $validated['postal_address'];
        $provider->message = $validated['message'] ?? null;
        $provider->photo = $photoPath;
        $provider->proof_document = $proofDocumentPath ? basename($proofDocumentPath) : null;
        $provider->proof_document_path = $proofDocumentPath;
        $provider->status = 'pending';
        $provider->save();

        //return redirect()->route('dashboard')->with('success', 'Registration submitted. Wait for admin approval.');
        return redirect()->route('provider.waiting')->with('success', 'Registration successful ! Wait for admin approval.');

    }

    public function dashboard()
        {
            $user = Auth::user()->load('provider');

            return view('provider.dashboard', compact('user'));
        }

    public function profile()
        {
            $user = auth()->user();
            return view('provider.profile', compact('user'));
        }

        




        public function requests()
        {
            $requests = ServiceRequest::with('customer')
                ->where('assigned_to', auth()->id()) // or provider_id if renamed
                ->orderBy('created_at', 'desc')
                ->get();

            return view('provider.requests', compact('requests'));
        }

        public function acceptRequest($id)
        {
            $request = ServiceRequest::where('id', $id)
                ->where('assigned_to', auth()->id()) // or provider_id
                ->firstOrFail();

            $request->status = 'accepted';
            $request->save();

            return back()->with('success', 'Service request accepted.');
        }

        public function rejectRequest($id)
        {
            $request = ServiceRequest::where('id', $id)
                ->where('assigned_to', auth()->id()) // or provider_id
                ->firstOrFail();

            $request->status = 'rejected';
            $request->save();

            return back()->with('success', 'Service request rejected.');
        }


}