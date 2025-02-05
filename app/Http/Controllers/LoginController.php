<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
       $validator =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('dashboard');
        }
        $validator['emailPassword'] = 'Email address or password is incorrect.';
        return redirect("/")->withErrors($validator);
    }

    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return route('companies.index');
    //     }

    //     return redirect("login")->withSuccess('You are not allowed to access');
    // }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
