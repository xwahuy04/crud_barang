<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // if(!Session()->has('loginId')) {
    //     return redirect('/')->with('fail','You have to login first.');
    // }
    // return $next($request);

    if (!Session::has('loginId')) {
            return redirect('/')->with('error', 'You need to login first');
        }
        return $next($request);
}
}
