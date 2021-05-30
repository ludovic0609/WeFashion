<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'name'
    ];
    //
    public function products(){
        //les tailles sont sur plusieurs produits.
        return $this->belongsToMany(Product::class);
        }
}
