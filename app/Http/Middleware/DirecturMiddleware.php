<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DirecturMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
    	$role = session()->get('role');
    	if($role == 1 || $role == 100 || $role == 200) {
	        return $next($request);
    	} else {
	        return redirect('dashboard');
    	}
    }
}
