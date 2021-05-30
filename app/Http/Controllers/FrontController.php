<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;
use Cache;



class FrontController extends Controller
{
    //6 produits par page
    protected $paginate = 6; // factorisation de la pagination 

    public function __construct(){

        // méthode pour injecter des données à une vue partielle 
        view()->composer('partials.menu', function($view){
            $products = Product::all(); // on récupère un tableau associatif
            $view->with('products', $products ); // on passe les données à la vue
        });

        view()->composer('partials/navbar-front', function($view){
            $categories = Category::all();// on récupère un tableau associatif
            $view->with('categories', $categories ); // on passe les données à la vue
        });
        
        view()->composer('partials/navbar-back', function($view){
            $categories = Category::all();// on récupère un tableau associatif
            $view->with('categories', $categories ); // on passe les données à la vue
        });


    }

   
    
    public function index(){
        // on recupere les produits visibles ordonné du plus recent au plus ancien
        $products= Product::where('product_visible', '1')->orderBy('id','DESC')->paginate($this->paginate);
        
        

        $prefix = request()->page?? 'home';
        $path = 'product' .$prefix;
        
  
        // retourne la view avec product en arguments      
        return view('front.index', ['products' => $products ]);


    }

    public function search(){
        // on recupere le contenu dans le input pour la recherche
        $search=request()->get('search');
        // on recherche les produits visible en fonction de ce qu'on a taper dans la recherche avec like %arg%
        $products= Product::where('name', 'LIKE', '%' . $search . '%')->where('product_visible', '1')->orderBy('id','DESC')->paginate($this->paginate);
  
        // retourne la view avec product et search en arguments
        return view('front.index', ['products' => $products,'search'=>$search ]);
    }


    public function indexDiscount(){
    
        // on recupere les produits en soldes 
        $products= Product::where('state_product','1')->where('product_visible', '1')->paginate($this->paginate);

        
       $active_discount='discount';


        
        return view('front.index', ['products' => $products,'active'=>$active_discount]);


    }

    public function indexCategory($id){
  
        // on recupere les produits en fonction de la catégorie qu'on a choisi dans la nav
        $products= Product::where('category_id',$id)->where('product_visible', '1')->paginate($this->paginate);
        $categories = Category::all()->where("id",$id)->first();
        $active_categorie= $categories->name;



      
        
        return view('front.index', ['products' => $products,'active_category'=>$active_categorie]);


    }

    



    // Fiche d'un produit
    public function show($id)
    {

        // on recuper le produit par l'id
        $product = Product::find($id);

      
        

        $discount=$product->state_product;
        
    
        // on recupere la categorie d'un produit
        $categories = Category::all()->where("id",$product->category_id)->first();


        return view('front.show', ['product' => $product ,'categories' => $categories,'discount' => $discount]);
    }



   


}
