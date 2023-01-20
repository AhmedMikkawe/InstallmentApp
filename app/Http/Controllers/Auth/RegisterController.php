<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InviteCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index(){
        $invite_code = request()->query('code');
        return view("auth.register", ['invite_code'=>$invite_code]);
    }
    function store(Request $request){
        
        $this->validate($request,[
            "username"=>"min:3|max:20|required",
            "fullname"=> "required|max:120|min:10",
            "email"=>"email|required|unique:users",
            "password"=>"required|confirmed",
            "nationalId"=>"required|unique:users",
            "nationalId-photo"=>"required",
            "phone-number"=>"required|min:6|unique:users"
        ]);
        $inviteCode = InviteCode::where('code', $request->code)->get();
        if(!$inviteCode->first() || !$inviteCode->first()->valid){
            return back()->with("status", "Invalid Invite Code");
        }
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
