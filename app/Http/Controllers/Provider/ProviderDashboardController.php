<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $provider = auth()->user();
        return view('provider.dashboard', compact('provider'));
    }
}
