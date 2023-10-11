<?php

namespace App\Imports;

use App\Models\invoices;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoicesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        // dd($rows[1]);:
        foreach ($rows as $row ){
            //  dd($row);
            invoices::create([
                'invoice_number' => $row['invoice_number'],
                // 'invoice_Date'    => $row['invoice_date'],
                // 'Due_date'    => $row['due_date'],
                'produit'    => $row['produit'],
                'section'    => $row['sectione'],
                'Amount_collection'    => $row['amount_collection'],
                'Amount_Commission'    => $row['amount_commission'],
                'Discount'    => $row['discount'],
                'Value_VAT'    => $row['value_vat'],
                'Value_VAT'    => $row['rate_vat'],
                'Total'    => $row['total'],
                'Status'    => $row['status'],
                // 'Value_Status'    => $row['value_status'],
                'note'    => $row['note'],
                'Payment_Date'    => $row['payment_date'],  
            ]);
        }
              
           
        
    }
}
