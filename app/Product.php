<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Picture;

class Product extends Model
{
    
    //
    protected $fillable = [
        'name', 'description', 'price', 'product_visible', 'state_product', 'reference'
    ];

    

    public function category(){
        return $this->belongsTo(Category::class);
        
      }
   
    // Get the product's image
    public function picture() {
        return $this->hasOne(Picture::class);
    }

     // Get the product's image
     public function sizes() {
        return $this->belongsToMany(Size::class);
    }

}
