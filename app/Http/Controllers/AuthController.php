<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

    //passwrd change page
    public function changePasswordPage(){
        return view('admin.password.change');
    }
    public function passwordChange(Request $request){
        $this->passwordValidationCheck($request);
        $dbPassword = User::where('id',Auth::user()->id)->select('password')->first()->password;//hash value
        $clientPassword = $request->oldPassword;//plain text
        if(Hash::check($clientPassword,$dbPassword)){
            $data = [
                'password'=> Hash::make($request->newPassword)
            ];

            User::where('id',Auth::user()->id)->update($data);


            return redirect()->route('category#list')->with(['successPasswordChange'=>'Success Password Change!']);
        };

        return back()->with(['notMatch'=>'Old password is not correct!']);
    }
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword'
        ])->validate();
    }
    // public function changePassword(Request $request){
    //     /*
    //         1. All field must be filled
    //         2. new password & confirm password length must be greater than 6
    //         3. new password & confirm password must same
    //         4. client old password must be same with db password
    //         5. password change
    //     */
    //     $this->passwordValidationCheck($request);
    // }


}


