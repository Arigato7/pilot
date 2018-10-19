<?php

namespace Pilot\Http\Middleware;

use Closure;
use Pilot\Role;
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
        $role = Role::findOrFail(Auth::user()->role_id);
        if (! ($role->name === 'teacher' 
            || $role->name === 'moderator'
            || $role->name === 'administrator')) {
            return redirect('/');
        }
        return $next($request);
    }
}
