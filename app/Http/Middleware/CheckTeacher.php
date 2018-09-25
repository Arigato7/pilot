<?php

namespace Pilot\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTeacher
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
        $role = Auth::user()->role->name;
        if (! ($role === 'teacher' 
            || $role === 'moderator'
            || $role === 'administrator')) {
            return redirect('/');
        }
        return $next($request);
    }
}
