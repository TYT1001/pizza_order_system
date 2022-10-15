<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        // dd(url()->current());
        //not to go back to login page and register page from other page
        if( !empty(Auth::user())){
            if(Auth::user()->role == 'user') {
                return back();
            }
            return $next($request);
        }

        return $next($request);
    }
}
