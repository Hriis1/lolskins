<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User; // Ensure you have the User model

class LoadUser
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
        if ($request->session()->has('user_id')) {
            // Fetch user from the database
            $user = User::find(session('user_id'));

            // Share the user object globally
            if ($user) {
                // You can use the view share method
                view()->share('user', $user);
            }
        }

        return $next($request);
    }
}
