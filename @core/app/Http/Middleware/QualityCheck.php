<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class QualityCheck
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
        
        // التحقق من أن المستخدم لديه دور Quality Agent أو Admin
        if (!$user->hasRole(['Quality Agent', 'Admin', 'Super Admin'])) {
            abort(403, 'Unauthorized access. Quality Agent role required.');
        }

        return $next($request);
    }
}

