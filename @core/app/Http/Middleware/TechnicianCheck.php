<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TechnicianCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login');
        }

        $user = Auth::guard('web')->user();
        
        // التحقق من أن المستخدم لديه دور Technician أو Admin
        if (!$user->hasRole(['Technician', 'Admin', 'Super Admin'])) {
            abort(403, 'Unauthorized access. Technician role required.');
        }

        return $next($request);
    }
}

