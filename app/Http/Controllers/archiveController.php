<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoices_Attachments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class archiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $var_invoices = invoices::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        // onlyTrashed => delete_at !== null  idn  jib lia g3 hdouk li mchaw softdelete
        return view('invoices.archive_invoices',compact('var_invoices'));
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

        $id= $request->invoice_id;
        $invoices_restoer= invoices::withTrashed()->where('id',$id)->restore();
        //withTrashed  = ya3ni dkhol lia invoices u sir lia ga3 hadouk li fihoum delete at 3mra u3zl w7da bi id
        // u dir liha restsoer b7la katndl delete at bu null
        //withTrashed   = delete_at !==null
        //restoer == rj3ou cas noral fctuer
        return redirect('/archive_invoices');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)

    {
        //  return request();
        $var_id= $request->invoice_id;
        $invoices = invoices::withTrashed()->where('id',$var_id)->first();
        $files =   invoices_Attachments::where('invoice_id',$var_id)->first();
        
        if (!empty($files->invoice_number)) {
            Storage::disk('uploads_fileme')->deleteDirectory($files->invoice_number);
        // Storage::disk('uploads_fileme')->deleteDirectory($files->invoice_number.'/'.$files->file_name);
        }
        $invoices->forcedelete();
        return redirect('/archive_invoices');

    }
}
