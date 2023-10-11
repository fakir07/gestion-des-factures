<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom_produit',
        'section_id',
        'description_produit',
    ];
    public function section() {
        return $this->belongsTo('App\Models\Sectiones');
    }
}
