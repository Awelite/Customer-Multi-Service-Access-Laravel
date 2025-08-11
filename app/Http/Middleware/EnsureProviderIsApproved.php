<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProviderIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Block non-providers
        if (!$user || $user->role !== 'provider') {
            abort(403, 'Access denied. Not a provider.');
        }

        // Redirect pending providers to waiting page
        if ($user->status === 'pending') {
            return redirect()->route('provider.waiting');
        }

        // Block rejected/suspended/other statuses (not approved or pending)
        if ($user->status !== 'approved') {
            return redirect('/')->with('error', 'Your provider account is not approved yet.');
        }

        // Approved providers go forward
        return $next($request);
    }
}
