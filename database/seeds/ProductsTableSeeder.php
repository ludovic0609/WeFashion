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

            

            
            // for every prooduct one category
            $category = Category::find(rand(1, 2));
            $product->category()->associate($category)->save();


          
                   
            // Add images
            $files = Storage::allFiles($category->name == "hommes" ? "hommes" : "femmes");
            $fileIndex = array_rand($files);
            $file = $files[$fileIndex];

            $product->picture()->create([
                'title' => 'Titre de l\'image',
                'link' => $file
            ]);
            
            $sizes =App\Size::pluck('id')->shuffle()->slice(0,rand(1,5))->all();

            $product->sizes()->attach($sizes);

            /*
            $random=rand(1,10);

            $folder = $product->category_id == 1 ? 'hommes' : 'femmes'; // define the folder in which picking the image

            // get a random image then store it
            
            $link = $random . '.jpg';
            $file = file_get_contents(asset('images/' . $folder . '/' . $random . '.jpg'));
            Storage::disk('local')->put($link, $file);

            // store the image in DB
            $product->picture()->create([
                'title' => 'Titre de l\'image',
                'link' => $link
            ])->save();*/

        });
    }
}
