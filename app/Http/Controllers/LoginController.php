<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function login(){
        return view ('login.form');
    }

    function auth(Request $req){
        $username=$req->username;
        $password=$req->password;
        $credentials=['username'=>$username,'password'=>$password];

        if(Auth::attempt($credentials)){
            session(['username'=>$username]);
            return redirect()-route('home');
        }else{
            return redirect()->back()-with('err','Failed to Login');
        }
    }

    function logout(){
        Auth::logout();
        session()->flush();
        return redirect ('/login');
    }
}
