<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!\Auth::check()) {
            return redirect()->route('adminLogInForm');
        }

        // Check if the authenticated user is an admin
        if (\Auth::user()->acc_type != 'admin') {
            return redirect()->route('main')->with('messageError', "Oops, you don't have admin permissions :)");
        }

        return $next($request);
    }
}
