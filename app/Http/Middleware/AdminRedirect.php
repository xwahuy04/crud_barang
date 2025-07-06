<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    //      if (!Session::has('loginId')) {
    //     return redirect('/login')->with('fail', 'Anda harus login terlebih dahulu');
    // }
    // return $next($request);
     if (!Session::has('userRole') || Session::get('userRole') !== 'admin') {
            return redirect('/login')->with('error', 'You do not have admin privileges');
        }
        return $next($request);
    }
}
