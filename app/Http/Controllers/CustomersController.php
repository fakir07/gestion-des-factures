<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\Sectiones;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //

    public function index()
    {

        $var_sections = Sectiones::all();
        return view('reports.reports_cust' ,compact('var_sections'));
    }



    public function Search_invoices_cust(Request $request){


        //return Request()->section;

        if ( $request->section !='' && $request->produit!='' && $request->start_at =='' && $request->end_at =='')
        
         {
             $invoices =invoices::select('*')->where('section','=',$request->section)->where('produit','=',$request->produit)->get();                                  
             $var_sections = Sectiones::all();
             return view('reports.reports_cust',compact('var_sections'))->withDetails($invoices); 
         }

         else{
            $start_at =date($request->start_at);
            $end_at =date($request->end_at);
            $invoices =invoices::select('*')->whereBetween('invoice_Date',[ $start_at,$end_at])->where('section','=',$request->section)->where('produit','=',$request->produit)->get();                                  
            $var_sections = Sectiones::all();
            return view('reports.reports_cust',compact('var_sections'))->withDetails($invoices); 
        

         }


    }
}
