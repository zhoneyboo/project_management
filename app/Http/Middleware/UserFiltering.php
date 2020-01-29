<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserFiltering
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
        if($role != 'admin' && !Auth::viaRemember() || !Auth::user())
        {
            abort(404);
        }
        return $next($request);
    }
}
