<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureCustomerRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Admins and editors belong in the admin panel, not the customer dashboard
        if ($user->hasRole(['admin', 'editor'])) {
            return redirect('/admin');
        }

        // Block anyone without the customer role
        if (!$user->hasRole('customer')) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
