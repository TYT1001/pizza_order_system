<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        // if( !empty(Auth::user())){

        //     if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')) {
        //         return back();
        //     }

        // }
        // dd(Auth::user()->role);
        if(Auth::user()->role == 'admin') {
            return back();
        }
        return $next($request);
    }

}


