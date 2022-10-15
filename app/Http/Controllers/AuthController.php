<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    // direct login Page
    public function loginPage() {
        return view('login');
    }

    //direct register Page
    public function registerPage() {
        return view('register');
    }

    public function dashboard() {
    // dd(Auth::user()->role);
        if( Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
            return redirect()->route('user#home');
    }




}


