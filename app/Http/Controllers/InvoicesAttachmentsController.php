<?php

namespace App\Http\Controllers;

use App\Models\invoices_Attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mime\MimeTypesInterface;

class InvoicesAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
    }

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'file_name' =>'mimes:png,jpg,pdf,jpge,zip',

        ],[
            'file_name.mimes' => '* Format de pièce jointe pdf, jpeg, .jpg, png'
        ]);

        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachments = new invoices_Attachments();
       

        $attachments->file_name = $file_name;
        $attachments->invoice_number = $request->invoice_number; 
        $attachments->Created_by = Auth::user()->name ?? '';
        $attachments->invoice_id = $request->invoice_id;
        //dd($request->invoice_id);
        $attachments->save();

        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('invoices_file/' . $request->invoice_number), $imageName);
        //return redirect('invoicedetails',$request->invoice_id);
        return redirect()->to('invoicedetails/'.$request->invoice_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_Attachments  $invoices_Attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_Attachments $invoices_Attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_Attachments  $invoices_Attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_Attachments $invoices_Attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_Attachments  $invoices_Attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_Attachments $invoices_Attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_Attachments  $invoices_Attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_Attachments $invoices_Attachments)
    {
        //
    }
}
