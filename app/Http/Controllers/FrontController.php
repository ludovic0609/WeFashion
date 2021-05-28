<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Cache;

class FrontController extends Controller
{
    //
    protected $paginate = 6; // factorisation de la pagination 

    public function __construct(){

        // méthode pour injecter des données à une vue partielle 
        view()->composer('partials.menu', function($view){
            $products = Product::all(); // on récupère un tableau associatif ['id' => 1]
            $view->with('products', $products ); // on passe les données à la vue
        });

        view()->composer('partials/navbar-front', function($view){
            $categories = Category::all();
            $view->with('categories', $categories ); // on passe les données à la vue
        });
        
        view()->composer('partials/navbar-back', function($view){
            $categories = Category::all();
            $view->with('categories', $categories ); // on passe les données à la vue
        });


    }

    
    public function index(){
        
        $products= Product::orderBy('id','DESC')->paginate($this->paginate);
        
        

        $prefix = request()->page?? 'home';
        $path = 'product' .$prefix;
        
       /* $products = Cache::remember($path, 60*24, function(){
        return Product::orderBy('id','DESC')->paginate($this->paginate);
    
        });*/

    
        
        
        
        return view('front.index', ['products' => $products ]);


    }

    public function indexDiscount(){
        /*
        $products= Product::orderBy('id','DESC')->paginate($this->paginate);
        $results= Product::all();
        $counts=$results->count();
        */

        $products= Product::where('state_product','1')->paginate($this->paginate);

       $active_discount='discount';


        
        /*$products = Cache::remember($path, 60*24, function(){
        return Product::where('state_product','0')->paginate($this->paginate);
        });*/
        
        
        return view('front.index', ['products' => $products,'active'=>$active_discount]);


    }

    public function indexCategory($id){
        /*
        $products= Product::orderBy('id','DESC')->paginate($this->paginate);
        $results= Product::all();
        $counts=$results->count();
        */

        $products= Product::where('category_id',$id)->paginate($this->paginate);
        $categories = Category::all()->where("id",$id)->first();
        $active_categorie= $categories->name;



        
        /*$products = Cache::remember($path, 60*24, function(){
        return Product::where('state_product','0')->paginate($this->paginate);
        });*/
        
        
        return view('front.index', ['products' => $products,'active_category'=>$active_categorie]);


    }

    



    // Fiche d'un produit
    public function show($id)
    {
        $product = Product::find($id);

      
        

        $discount=$product->state_product;
        
    
        
        $categories = Category::all()->where("id",$product->category_id)->first();


        return view('front.show', ['product' => $product ,'categories' => $categories,'discount' => $discount]);
    }



   


}
