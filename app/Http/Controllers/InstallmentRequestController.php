<?php

namespace App\Http\Controllers;

use App\Models\InstallmentRequest;
use Illuminate\Http\Request;

class InstallmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $requests = InstallmentRequest::where('user_id',auth()->user()->id)->get();
        return view("frontend.installmentRequest.index",['requests'=>$requests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view("frontend.installmentRequest.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'required_device'=> 'required|min:3',
        ]);
        InstallmentRequest::create([
            'required_device'=>$request->required_device,
            'request_type' => $request->request_type,
            'user_id'=> auth()->user()->id
            ]);
        return redirect()->route("installmentRequest.index")->with("status","Installment Request Registered Successfully and it's under review");
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
        //
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
        //
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
