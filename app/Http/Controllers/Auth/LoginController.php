<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function index(){
        return view("auth.login");
    }
    function store(Request $request){
        $login_type = filter_var(request()->input('email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone-number';

        $this->validate($request,[
            "email"=>"required",
            "password"=>"required",
        ]);
        if(!auth()->attempt([
            "$login_type"=>$request->email,
            'password'=>$request->password
        ])){
            return back()->with("status", "Invalid Login Details");
        }
        if (auth()->user()->hasAnyRole('super-admin','moderator')){
            return redirect()->route("admin");
        }
        return redirect()->route("home");
    }

}
