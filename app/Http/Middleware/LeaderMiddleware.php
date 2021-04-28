<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LeaderMiddleware
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
    	if($role == 1 || $role == 100 || $role == 201 || $role == 202) {
	        return $next($request);
    	} else {
	        return redirect('dashboard');
    	}
    }
}
