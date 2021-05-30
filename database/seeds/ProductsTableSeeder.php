<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\Picture;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
     
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // on prendra garde de bien supprimer toutes les images avant de commencer les seeders
        

       
       

        // création de 80 produits à partir de la factory
        factory(App\Product::class, 80)->create()->each(function($product){

            

            
            // Pour un produit une catégorie attribué
            $category = Category::find(rand(1, 2));
            $product->category()->associate($category)->save();


          
                   
            // Ajouter une image
            $files = Storage::allFiles($category->name == "hommes" ? "hommes" : "femmes");
            $fileIndex = array_rand($files);
            $file = $files[$fileIndex];

            //cree une image par produit
            $product->picture()->create([
                'title' => 'Titre de l\'image',
                'link' => $file
            ]);
            //genere aleatoirement des tailles par produit, de 1 à 5 possible tailles
            $sizes =App\Size::pluck('id')->shuffle()->slice(0,rand(1,5))->all();

            //associe les tailles avec le produit en question
            $product->sizes()->attach($sizes);

           

        });
    }
}
