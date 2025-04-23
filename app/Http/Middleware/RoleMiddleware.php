<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Use Spatie's hasRole method to check if the user has the required role
        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}

