<?php

namespace App\Http\Controllers;

use App\Models\InstallmentRequest;
use App\Models\User;
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
    public function all(){
        $installments = InstallmentRequest::get();
        return view("admin.installments.index",['installments'=> $installments]);
    }
    public function allRejected(){
        $installments = InstallmentRequest::where('request_status' , 'rejected')->get();
        return view("admin.installments.index",['installments'=>$installments]);
    }
    public function allApproved(){
        $installments = InstallmentRequest::where('request_status' , 'approved')->get();
        return view("admin.installments.index",['installments'=>$installments]);
    }
    public function allPending(){
        $installments = InstallmentRequest::where('request_status' , 'pending')->get();
        return view("admin.installments.index",['installments'=>$installments]);
    }
    public function showInstallmentRequest($id){
        $request = InstallmentRequest::with(['user','installments'])->where('id',$id)->first();
        return view("admin.installments.show",['request'=>$request]);
    }
    public function editInstallmentRequest($id){
        $request = InstallmentRequest::where('id',$id)->first();
        return view("admin.installments.edit",['request'=>$request]);

    }
    public function updateInstallmentRequest(Request $request, $id){
        $this->validate($request,[
            'required_device'=> 'required',
            'installment_value'=>'required|numeric',
            'installment_count'=>'required|integer'
        ]);
        InstallmentRequest::where('id',$id)->update([
            'required_device' =>$request->required_device,
            'request_status' =>$request->request_status,
            'request_type' =>$request->request_type,
            'installment_value' =>$request->installment_value,
            'installment_count' =>$request->installment_count,
            'total' =>$request->installment_value * $request->installment_count,
        ]);
        return redirect()->route("allInstallmentRequests")->with('success','installment request updated successfully');
    }
    public function adminAddInstallmentRequest(){
        $users = User::get();
        return view("admin.installments.create",['users'=>$users]);
    }
    public function adminStoreInstallmentRequest(Request $request){
        $this->validate($request,[
            'required_device'=> 'required',
            'installment_value'=>'required|numeric',
            'installment_count'=>'required|integer',
            'user'=> 'required'
        ]);
        $user = User::where('id',$request->user)->firstOrFail();
        $user->installment_requests()->create([
            "required_device" => $request->required_device,
            "request_type" => $request->request_type,
            "request_status" => $request->request_status,
            "installment_value" => $request->installment_value,
            "installment_count" => $request->installment_count,
            "total" => $request->total
        ]);
        return redirect()->route("allInstallmentRequests")->with("success","created installment request for user $user->fullname successfully");
    }

}
