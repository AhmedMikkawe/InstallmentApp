<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\InstallmentRequest;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,[
           'receipt_photo'=>'required|image',
           'value'=>'required|numeric'
        ]);
        $installmentRequest = InstallmentRequest::where('id',$id)->first();

        if ($installmentRequest->installment_count > $installmentRequest->installments()->where('installment_status','approved')->count()){

            $installmentRequest->installments()->create([
                'receipt_photo'=> $fileName = time().'.'.$request->file('receipt_photo')->extension(),
                'value' => $request->value,
                'date' => now()
            ]);
            $request->file('receipt_photo')->move(public_path('uploads/installment_receipt'), $fileName);
            return redirect()->route("installmentRequest.show", $id)->with('success', 'Installment created successfully and it\'s under review');
        }
        return redirect()->route("installmentRequest.show", $id)->with('faild', 'You Can\'t add installment to this request');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
        $request = InstallmentRequest::With('installments')->where('id',$id)->firstOrFail();
        return view('frontend.installmentRequest.show',['request'=>$request]);
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
