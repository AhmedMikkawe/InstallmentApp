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
            "username"=>"min:3|max:20|required|unique:users",
            "fullname"=> "required|max:120|min:10",
            "email"=>"required_without:phone-number|unique:users",
            "password"=>"required|confirmed",
            "nationalId"=>"required|unique:users",
            "nationalId-photo"=>"required|image|mimes:jpg,png,jpeg",
            "phone-number"=>"required_without:email|unique:users"
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
            "nationalId-photo"=>  $fileName = time().'.'.$request->file('nationalId-photo')->extension(),
            "phone-number"=> $request->get("phone-number")
        ]);
        InviteCode::where('code', $request->code)->update([
            'valid'=> False
        ]);
        $request->file('nationalId-photo')->move(public_path('uploads/customer_nationalId'), $fileName);
        auth()->attempt($request->only("email","password"));
        return redirect()->route("kafeel.create");
    }
}
