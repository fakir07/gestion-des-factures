<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //
    
    public function index()
    {
         
        return view('reports.report');
    }

    public function Search_invoices(Request $request){

        $var_radio= $request->rdio;
       
        if( $var_radio == 1){

             // date == nulle
            if( $request->type !='' && $request->start_at =='' && $request->end_at ==''){

                $invoices =invoices::select('*')->where('Status','=',$request->type)->get();

                $type =$request->type;
                return view('reports.report',compact('type'))->withDetails($invoices);
            }

            //date !==null
            else{
                $start_at =date($request->start_at);
                $end_at =date($request->end_at);
                $invoices =invoices::select('*')->whereBetween('invoice_Date',[ $start_at,$end_at])->where('Status','=',$request->type)->get();
                $type =$request->type;
                return view('reports.report',compact('type','start_at','end_at'))->withDetails($invoices);

            }
        }
        else{

            $invoices =invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            $var_invoices= $request->invoice_number;
            return view('reports.report' ,compact('var_invoices'))->withDetails($invoices);

        }

    }
}
