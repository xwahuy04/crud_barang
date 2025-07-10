<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SupervisiorCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('userRole') || Session::get('userRole') !== 'supervisor') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses supervisor');
        }
        return $next($request);
    }
}
