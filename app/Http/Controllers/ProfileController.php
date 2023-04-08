<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function edit(){
        return view('admin.profile.edit');
    }
    function update( Request $request){
        $user = User::where('id',auth()->user()->id)->firstOrFail();
        $this->validate($request,[
           'email'=>'email|unique:users'
        ]);
        if(Hash::check($request->password,$user->password)){
            $user->update(['email'=> $request->email]);
        }else{
            return redirect()->route('profile.edit')->with('wrong password','كلمة السر خاطئة');
        }
     return redirect()->route('profile.edit')->with('updated','تم تغيير البيانات بنجاح');
    }
}
