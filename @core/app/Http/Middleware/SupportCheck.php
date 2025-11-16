<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SupportCheck
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
        
        // التحقق من أن المستخدم لديه دور Support Agent أو Admin
        if (!$user->hasRole(['Support Agent', 'Admin', 'Super Admin'])) {
            abort(403, 'Unauthorized access. Support Agent role required.');
        }

        return $next($request);
    }
}

