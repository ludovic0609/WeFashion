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
        //un produit ne peux avoir qu'une catégorie
        return $this->belongsTo(Category::class);
        
      }
   
    // Get the product's image
    public function picture() {
        //un produit a une seul image.
        return $this->hasOne(Picture::class);
    }

     // Get the product's image
     public function sizes() {
         //les produits peuvent avoir plusieurs tailles.
        return $this->belongsToMany(Size::class);
    }

}
