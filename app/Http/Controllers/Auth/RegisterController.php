<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index(){
        return view("auth.register");
    }
    function store(Request $request){
        $this->validate($request,[
            "username"=>"min:3|max:20|required",
            "fullname"=> "required|max:120|min:10",
            "email"=>"email|required",
            "password"=>"required|confirmed",
            "nationalId"=>"required",
            "nationalId-photo"=>"required",
            "phone-number"=>"required|min:6"
        ]);
        User::create([
            "fullname" => $request->fullname,
            "username" => $request->username,
            "email" => $request->email,
            "password"=> Hash::make($request->password),
            "nationalId" => $request->nationalId,
            "nationalId-photo"=> $request->get("nationalId-photo"),
            "phone-number"=> $request->get("phone-number")
        ]);
        auth()->attempt($request->only("email","password"));
        return redirect()->route("home");
    }
}
