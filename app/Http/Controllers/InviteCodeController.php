<?php

namespace App\Http\Controllers;

use App\Models\InviteCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InviteCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invite_codes = InviteCode::all();
        return view("admin.invite_code.index",["invite_codes"=>$invite_codes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = Str::random(10);
        return view("admin.invite_code.create",['code'=>$code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => "required|unique:invite_code"
        ]);
        InviteCode::create([
            'code'=>$request->code,
            'valid'=>TRUE
        ]);
        return redirect()->route("invite_code.create")->with("success","Invite Code Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inviteCode = InviteCode::where('id',$id)->first();
        return view("admin.invite_code.edit", ['inviteCode'=>$inviteCode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        InviteCode::where("id", $id)->update(["valid" => $request->valid]);
        return redirect()->route("invite_code.index")->with('success',"Invite Code Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
