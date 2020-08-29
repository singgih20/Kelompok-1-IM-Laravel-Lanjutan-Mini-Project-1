<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $role = Auth::user()->userRole();
        if ($role=='admin') {
            return $next($request);
        }
        $route = $request->route()->uri;
        return response()->json(['message'=> $role." dilarang mengakses ".$route], 403);
    }
}
