<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    
    //
    protected $fillable = [
        'link',
        'title'
    ];
    public function product() {
        //une image est associé à un produit
        return $this->belongsTo(Product::class);
    }
}
