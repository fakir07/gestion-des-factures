<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\Invoices_Details;
use App\Models\invoices_Attachments;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $var_invoices = invoices::where('id',$id)->first();
        //first() => function katjibb lina row w7da dyl dak id li l9ato
        $var_deatiles = Invoices_Details::where('id_invoice',$id)->get();
        //get() => function to laravel kadir loop katjib lik ga3 li 3ndhoum dak id =id li   ghadi t3tiha 
        $var_files= invoices_Attachments::where('invoice_id',$id)->get();
        return view('invoices.invoicesdetails',compact('var_invoices','var_deatiles','var_files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices_Details $invoices_Details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_Details $invoices_Details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_Details  $invoices_Details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoices_Attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('uploads_fileme')->delete($request->invoice_number.'/'.$request->file_name);
       // Storage::disk('uploads_fileme')->delete($request->file_name);
        //mn ghdii dkhol storg path  dkholl lia attchemnt fil u zid dhol lia file li fih invoice number u ms7 dkchii li fif

        session()->flash('supprimer', 'pièce jointe supprimée avec succès');
        return back();
      
    }

    // function open file
    
    public function open_file($invoice_number , $file_name){


        $var_files= Storage::disk('uploads_fileme')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        ///$var_files= Storage::disk('uploads_fileme')->getDriver()->getAdapter()->applyPathPrefix($file_name);
      // ->getAdapter()->applyPathPrefix hdoo houma li bach kadkhoo; massr dyl file u kdi m3ak joj varil li jtihum bach ila9houl lik 
       // ki3ini mn nclickw 3la btn ykhod lian dok joj varil u itb3 path dyl storg finn kynfila u i9alb lina 3la doosier bi invoice number idkhol lih hit drna / 3ad iafficher lia file bi smia dylo
       return response()->file($var_files);

    }

    //fuction telecharger
    public function telecharger_file($invoice_number , $file_name){
      $var_telecharger= Storage::disk('uploads_fileme')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
       // $var_telecharger= Storage::disk('uploads_fileme')->getDriver()->getAdapter()->applyPathPrefix($file_name);
        return response()->download($var_telecharger);

    }

}
