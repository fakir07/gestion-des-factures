<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;

    // protected $guarded =[];
    use SoftDeletes;
    // protected $ = ['deleted_at'];
   
    protected $fillable =[
        'invoice_number',
        'invoice_Date',
        'Due_date',
        'produit',
        'section',
        'Amount_collection',
        'Amount_Commission',
        'Discount',
        'Value_VAT',
        'Rate_VAT',
        'Total',
        'Status',
        'Value_Status',
        'note',
        'Payment_Date',
    ];

    public function sectione() {
        return $this->belongsTo('App\Models\Sectiones','section');
    }

    // invoice 3ndha bzf dyl athhacmnets
    public function attachments() {
        return $this->hasMany('App\Models\invoices_Attachments','invoice_id');
    }

}
