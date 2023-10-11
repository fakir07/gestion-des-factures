<?php

namespace App\Exports;

use App\Models\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoicesExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $invoices = invoices::all() ;
        return  $invoices;
        // return invoices::select('aa','ee');
    }

    public function map($invoices) : array {
        return [
            $invoices->invoice_number,
            $invoices->invoice_Date,
            $invoices->Due_date,
            $invoices->produit,
            $invoices->sectione->section_nom ,
            $invoices->Amount_collection,
            $invoices->Amount_Commission,
            $invoices->Discount,
            $invoices->Value_VAT,
            $invoices->Rate_VAT,
            $invoices->Total,
            $invoices->Status,
            $invoices->note,
            $invoices->Payment_Date,
        ];
    }
    // public function view(): View
    // {
    //     return view('.invoices', [
    //         'invoices' => Invoice::all()
    //     ]);
    // }

    public function headings() :array
    {
        return ["invoice_number","invoice_Date","Due_date","produit","sectione","Amount_collection","Amount_Commission","Discount","Value_VAT","Rate_VAT","Total","Status","note","Payment_Date"];
        // return ["invoice_number","invoice_Date","Due_date","produit","sectione","Amount_collection","Amount_Commission","Discount","Value_VAT","Rate_VAT","Total","Status","note"];
    }
}

