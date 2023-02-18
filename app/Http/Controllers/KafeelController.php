<?php

namespace App\Http\Controllers;

use App\Models\Kafeel;
use Illuminate\Http\Request;

class KafeelController extends Controller
{
    public function create(){
        $auth_user = auth()->user();
        return view("frontend.kafeel.create",['user_id'=>$auth_user->id]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'fullname'=>'max:120|min:10',
            'national_id' =>'',
            'phone_number'=>'min:6',
            'national_id_photo' =>'image|mimes:jpg,png,jpeg',
            'user_id'=>'unique:kafeel'
        ]);
        Kafeel::create([
            'fullname'=> $request->fullname,
            'national_id' =>$request->national_id,
            'phone_number'=>$request->phone_number,
            'national_id_photo' => $fileName = time().'.'.$request->file('national_id_photo')->extension(),
            'user_id'=>$request->user_id
            ]);
        $request->file('national_id_photo')->move(public_path('uploads/kafeel_nationalId'), $fileName);
        return redirect()->route("home");

    }
    public function edit($id){
        $kafeel = Kafeel::where('user_id',$id)->first();
        return view("frontend.kafeel.update",["kafeel"=>$kafeel]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'fullname'=>'max:120|min:10',
            'national_id' =>'',
            'phone_number'=>'min:6',
            'national_id_photo' =>'image|mimes:jpg,png,jpeg',
        ]);
        Kafeel::where("id", $id)->update([
            'fullname'=> $request->fullname,
            'phone_number'=> $request->phone_number,
            'national_id'=> $request->national_id
        ]);
        if($request->hasFile("national_id_photo")){
            Kafeel::where('id',$id)->update([
                'national_id_photo' => $fileName = time().'.'.$request->file('national_id_photo')->extension()
            ]);
            $request->file('national_id_photo')->move(public_path('uploads/kafeel_nationalId'), $fileName);
        }

        return redirect()->route("kafeel.edit",$id)->with('success',"Kafeel Information Updated Successfully");
    }
}
