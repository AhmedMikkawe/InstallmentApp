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
        $this->validate($request,[
            "email"=>"email|required",
            "password"=>"required",
        ]);
        if(!auth()->attempt($request->only("email","password"))){
            return back()->with("status", "Invalid Login Details");
        }
        return redirect()->route("home");
    }
}
