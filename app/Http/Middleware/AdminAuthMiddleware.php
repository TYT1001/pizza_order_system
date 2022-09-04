<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        //not to go back to login page and register page from other page
        // if( !empty(Auth::user())){

        //     if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')) {
        //         return back();
        //     }
        // }

        if(Auth::user()->role == 'user') {
            return back();
        }

        return $next($request);
    }
}
