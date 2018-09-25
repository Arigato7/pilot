<?php

namespace Pilot\Http\Middleware;

use Closure;

class CheckModer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! ($role === 'moderator'
            || $role === 'administrator')) {
            return redirect('/');
        }
        return $next($request);
    }
}
