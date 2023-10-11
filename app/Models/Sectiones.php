<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectiones extends Model
{
    //use HasFactory;

    protected $fillable =[
        'section_nom',
        'description',
        'créé_par',
    ];

    public function produits() {
        return $this->hasMany('App\Models\Produits', 'section_id');
    }
}
