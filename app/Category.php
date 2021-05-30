<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];
    
    //
    public function products() {
        //une categorie peux etre sur plusieurs produits.
        return $this->hasMany(Product::class);
    }
}
