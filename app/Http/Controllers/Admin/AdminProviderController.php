<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Provider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::with('user')->orderByDesc('created_at')->get();
        return view('admin.providers.index', compact('providers'));
    }

    public function show($id)
    {
        $provider = Provider::with('user')->findOrFail($id);
        return view('admin.providers.show', compact('provider'));
    }

    public function approve($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->status = 'approved';
        $provider->save();

        $provider->user->status = 'approved';
        $provider->user->save();

    return redirect()->route('admin.providers.index')->with('success', 'Provider Approved!');
    }

    public function decline($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->status = 'declined';
        $provider->save();

        $provider->user->status = 'declined';
        $provider->user->save();

        return redirect()->back()->with('error', 'Provider declined.');
    }
    


}
