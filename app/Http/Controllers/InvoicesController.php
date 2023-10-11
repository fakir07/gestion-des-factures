<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\sections;
use App\Models\Sectiones;
use Illuminate\Http\Request;
use App\Models\Invoices_Details;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\invoices_Attachments;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Nullable;

use App\Exports\InvoicesExport;
use App\Imports\InvoicesImport;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $var_invoices= invoices::all();
          return view('invoices.invoice',compact('var_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $var_sectiones = Sectiones::all();
        return  view('invoices.add_invoice',compact('var_sectiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->Value_VAT);

        invoices::create([      
            //'invoice_number'=> 'F' . sprintf("%05d", $request->invoice_number. '-' . date('dmy')),
            'invoice_number'=>$request->invoice_number,
             'invoice_Date'=>$request->invoice_Date,
             'Due_date'=>$request->Due_date,
             'produit'=>$request->produit,
             'section'=>$request->section,
             'Amount_collection'=>$request->Amount_collection,
             'Amount_Commission'=>$request->Amount_Commission,
             'Discount'=>$request->Discount,
             'Value_VAT'=>$request->Value_VAT,
             'Rate_VAT'=>$request->Rate_VAT,
             'Total'=>$request->Total,
             'Status'=>'Factures impayées',
             'Value_Status'=>'2',
             'note'=>$request->note,


        ]);

           $var_id_invoice = invoices::latest()->first()->id;
           Invoices_Details::create([
               'id_invoice'=>$var_id_invoice,
               'invoice_numbre'=>$request->invoice_number,
               'poduit'=>$request->produit,
               'section'=>$request->section,
               'note'=>$request->note,
               'Status'=>'Factures impayées',
               'Value_Status'=>'2',
               'user'=>(Auth::user()->name ?? ''),
           ]);

           if ($request->hasFile('aziz')) {

            $var_invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('aziz');
            $invoice_number = $request->invoice_number;
            $file_name = $image->getClientOriginalName();
           
            $attachments = new invoices_Attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name ?? '';
            $attachments->invoice_id = $var_invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->aziz->getClientOriginalName();
            $request->aziz->move(public_path('invoices_file/' . $invoice_number), $imageName);
            // hadi katswb file wst fila bi invoice number
           // $request->aziz->move(public_path('invoices_file/'), $imageName);

        }


            session()->flash('Add', 'La section a été ajoutée avec succès ');
            return redirect('/invoices');


            /////////////////////////////////////////////////////  test cod 2   number fctuer  kat tzad automatique////////////////
        //     $inv = new invoices();
        //     $inv->invoice_number = 'inv';
        //     $inv->invoice_Date = $request->invoice_Date;
        //     $inv->Due_date = $request->Due_date;
        //     $inv->produit = $request->produit;
        //     $inv->section = $request->section;
        //     $inv->Amount_collection = $request->Amount_collection;
        //     $inv->Amount_Commission = $request->Amount_Commission;
        //     $inv->Discount = $request->Discount;
        //     $inv->Value_VAT = $request->Value_VAT;
        //     $inv->Rate_VAT = $request->Rate_VAT;
        //     $inv->Total = $request->Total;
        //     $inv->Value_Status = '2';
        //     $inv->note = $request->note;
        //     $inv->Status = 'Factures impayées';

        //     $inv->save();
        //     $inv->invoice_number = 'F' . sprintf("%05d", $inv->id) . '-' . date('dmy');
        //     $inv->save();





        //    $var_id_invoice = invoices::latest()->first()->id;
        //    Invoices_Details::create([
        //        'id_invoice'=>$var_id_invoice,
        //        'invoice_numbre'=>$inv->invoice_number,
        //        'poduit'=>$request->produit,
        //        'section'=>$request->section,
        //        'note'=>$request->note,
        //        'Status'=>'Factures impayées',
        //        'Value_Status'=>'2',
        //        'user'=>(Auth::user()->name ?? ''),
        //    ]);

        //    if ($request->hasFile('aziz')) {

        //     $var_invoice_id = Invoices::latest()->first()->id;
        //     $image = $request->file('aziz');
        //     $invoice_number = $inv->invoice_number;
        //     $file_name = $image->getClientOriginalName();
           
        //     $attachments = new invoices_Attachments();
        //     $attachments->file_name = $file_name;
        //     $attachments->invoice_number = $invoice_number;
        //     $attachments->Created_by = Auth::user()->name ?? '';
        //     $attachments->invoice_id = $var_invoice_id;
        //     $attachments->save();

        //     // move pic
        //     $imageName = $request->aziz->getClientOriginalName();
        //     $request->aziz->move(public_path('invoices_file/' . $invoice_number), $imageName);
        //     // hadi katswb file wst fila bi invoice number
        //    // $request->aziz->move(public_path('invoices_file/'), $imageName);

        // }


        //     session()->flash('Add', 'La section a été ajoutée avec succès ');
        //     return redirect('/invoices');
           
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return request()->id;h

        $var_invoices= invoices::where('id',$id)->first();
        return view('invoices.update_status',compact('var_invoices'));
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $var_invoices = invoices::where('id',$id)->first();
        // first=> ghdii irj43 lina row 1
        $var_sectiones = Sectiones::all();
        return view('invoices.updateinvoice',compact('var_invoices','var_sectiones'));
               

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return request()->invoice_id; => 7
        //findOrfail => 9albii lia 3la ga3 les info dyl table   li fi table invoices  bi 7ayt 
        // Njibouh bi id li  jay mn return request()->invoice_id; 
        $v_editinvoice = invoices::findOrfail($request->invoice_id);
       // dd($v_editinvoice);
        $v_editinvoice->update([  
            'invoice_number'=>$request->invoice_number,
             'invoice_Date'=>$request->invoice_Date,
             'Due_date'=>$request->Due_date,
             'produit'=>$request->produit,
             'section'=>$request->section,
             'Amount_collection'=>$request->Amount_collection,
             'Amount_Commission'=>$request->Amount_Commission,
             'Discount'=>$request->Discount,
             'Value_VAT'=>$request->Value_VAT,
             'Rate_VAT'=>$request->Rate_VAT,
             'Total'=>$request->Total,
             'note'=>$request->note,

        ]);

        // $v_detail =  Invoices_Details::where('id_invoice',$request->invoice_id)->first();
        //  dd($v_detail);
        // $v_detail->update([ 
        //  ]);
        // bojo khdmin lwla katjib lik bi dkchii li 3ndk fi request ama tania kat3tiik akher line dart liha upadte aw tzdat

       Invoices_Details::where('id_invoice',$request->invoice_id)->first()->update([
            'id_invoice'=>$request->invoice_id,
            'invoice_numbre'=>$request->invoice_number,
            'poduit'=>$request->produit,
            'section'=>$request->section,
            'note'=>$request->note,
            'user'=>(Auth::user()->name ?? ''),
        ]);


        // $va_upadte_detail = Invoices_Details::latest()->first()->id;
        // // dd($var_id);
        // $va_upadte_detail->update([
        //     'id_invoice'=>$request->invoice_id,
        //     'invoice_numbre'=>$request->invoice_number,
        //     'poduit'=>$request->produit,
        //     'section'=>$request->section,
        //     'note'=>$request->note,
        //     'user'=>(Auth::user()->name ?? ''),
        // ]);
        // dd($va_upadte_detail);
           //dd($v_editinvoice->attachments);

          if(sizeof($v_editinvoice->attachments) > 0){

                invoices_Attachments::where('invoice_id',$request->invoice_id)->first()->update([
                'invoice_id'=>$request->invoice_id,
                'invoice_number'=>$request->invoice_number,
                
                
                ]);

                
               
                

         }

        
        session()->flash('Add', 'update invoice avec succès ');
        return redirect('/invoices');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

         $var_id= $request->invoice_id;
        //  $var_id2= $request->id_page;
        //  dd($var_id2); =>2 
         $invoice = invoices::where('id',$var_id)->first();
         $files =   invoices_Attachments::where('invoice_id',$var_id)->first();




         // ila knt use soft delete u bghiit  nrj3 invoices n7yd had cod li ta7t li kims7 files mn server
        //dd($files->invoice_number);
        $id = $request->id_page;

            if(!$id==2){

            if (!empty($files->invoice_number)) {
                Storage::disk('uploads_fileme')->deleteDirectory($files->invoice_number);
            // Storage::disk('uploads_fileme')->deleteDirectory($files->invoice_number.'/'.$files->file_name);
            }

            $invoice->forcedelete();
            return redirect('/invoices');

            }else{
                $invoice->delete();
                return redirect('/invoices');
        }

       
    }









/////////////// function get produit ajax
    public function getproduit($id){

        $var_json = DB::table('produits')->where("section_id",$id)->pluck("nom_produit","id");
        return json_decode($var_json);

        

    }



    public function update_status($id,Request $request){

    //    // dd($id);
        $var_update_status =invoices::findOrFail($id);
         //return $var_update_status;  dba hada katjib lina status ba9a null u date  hta kanchofo requst bach 3mrha 3ad kandiro liha upadte
        //return request()->Payment_Date;  
        if($request->Status === 'paid'){
            $var_update_status->update([
                'Value_Status' =>'1' ,
                'Status'=>$request->Status,
                'Payment_Date'=>$request->Payment_Date,
            ]);
            Invoices_Details::create([
                'id_invoice'=>$request->invoices_id,
                'invoice_numbre'=>$request->invoice_number,
                'poduit'=>$request->produit,
                'section'=>$request->section,
                'note'=>$request->note,
                'Status'=>$request->Status,
                'Payment_Date'=>$request->Payment_Date,
                'Value_Status' =>'1',
                'user'=>(Auth::user()->name ?? ''),
            ]);
        }else{
            $var_update_status->update([
                'Value_Status' =>'3' ,
                'Status'=>$request->Status,
                'Payment_Date'=>$request->Payment_Date,
            ]);
            Invoices_Details::create([
                'id_invoice'=>$request->invoices_id,
                'invoice_numbre'=>$request->invoice_number,
                'poduit'=>$request->produit,
                'section'=>$request->section,
                'note'=>$request->note,
                'Status'=>$request->Status,
                'Payment_Date'=>$request->Payment_Date,
                'Value_Status' =>'3',
                'user'=>(Auth::user()->name ?? ''),
            ]);

        };


        //return redirect()->to('invoices');
        return redirect('/invoices');
    }



    // function factures_payees

    public function factures_payees(){

        $var_invoices=invoices::where('Value_Status',1)->get();
        return view('invoices.factures_payees',compact('var_invoices'));
    }
        
    
    // function factures_impayees

    public function factures_impayees(){
        $var_invoices=invoices::where('Value_Status',2)->get();
        return view('invoices.factures_impayees',compact('var_invoices'));
    }
        
    
    // function factures_payees

    public function factures_partiellement_payees(){
        $var_invoices=invoices::where('Value_Status',3)->get();
        return view('invoices.factures_partiellement_payees',compact('var_invoices'));
    }



    public function Print_invoice($id){
        return invoices::first();
    }


    // excel
    
    public function export() 
    {
        return \Excel::download(new InvoicesExport, 'users.xlsx');
    }
        

    public function import_files(Request $request){

        $request->validate([
            'files' => 'required|file|mimes:csv,xlsx,xls'
        ]);
        //import
        Excel::import(new InvoicesImport, $request->file('files'));
        
        return redirect()->back()->with('status', 'Solde initial des Copropriétaire est insérer avec succès.');

    }
    
    
}
