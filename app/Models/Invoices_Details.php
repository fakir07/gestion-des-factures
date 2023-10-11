<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_Details extends Model
{
    use HasFactory;

       // protected $guarded =[];
       protected $fillable =[
         'id_invoice',
         'invoice_numbre',
         'poduit',
         'section',
         'Status',
         'Value_Status',
         'Payment_Date',
         'note',
         'user',

       ];

}
