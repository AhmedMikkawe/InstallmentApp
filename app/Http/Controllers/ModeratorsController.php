<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class ModeratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with("roles")->whereHas("roles", function($q) {
            $q->whereIn("name", ["super-admin","moderator"]);
        })->get();

        return view('admin.moderators.index',['users'=>$users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all()->pluck("name");
        return view("admin.moderators.create",['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username'=> 'required|unique:users',
            'fullname'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);
        $user = User::create([
            "fullname" => $request->fullname,
            "username" => $request->username,
            "email" => $request->email,
            "password"=> Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->route('moderators.index')->with('success','تم إنشاء المشرف بنجاح');
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
        $mod = User::with("roles")->findOrFail($id);
        $roles = Role::all()->pluck("name");

        return view("admin.moderators.edit",['mod'=>$mod,"roles"=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $mod = User::with("roles")->findOrFail($id);
        $this->validate($request,[
            'username'=> 'required|unique:users,username,'.$id.'id',
            'fullname'=> 'required',
            'email'=> 'required|email|unique:users,email,'.$id.'id',
            'role'=> 'required'
        ]);
            if($mod->hasRole($request->role)){
                $mod->update([
                    'username'=> $request->username,
                    'fullname'=> $request->fullname,
                    'email'=> $request->email,
                ]);

            }else{
                $mod->update([
                    'username'=> $request->username,
                    'fullname'=> $request->fullname,
                    'email'=> $request->email,
                ]);
                $mod->removeRole($mod->getRoleNames()->first());
                $mod->assignRole($request->role);
            }
            return redirect()->route('moderators.index')->with("success",'تم التحديث بنجاح');
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
