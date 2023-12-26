<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleUnverifiedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->email_verified_at === null){
            auth()->logout();

            $request->session()->flush();

            return redirect('/')->with('error', 'Your email is not verified. Please check your email for a verification link.');
        }

        return $next($request);
    }
}
