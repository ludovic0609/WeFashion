<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Picture;
use App\Size;
use DB;

use Storage;

class ProductController extends Controller
{

    //nombres de produits par page
    protected $paginate = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retourne tout les produits avec la pagination 
        $products = Product::paginate($this->paginate);
        //recupere toutes les categories
        $categories = Category::all();
        
        
        //retourne la view de la gestion des produits avec en arguments les produits et les categories
        return view('back.product.index', ['products' => $products,'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //retourne la view pour crée un produit avec la listes des categories et la listes des tailles
    public function create()
    {
        
        $categories = Category::pluck('name', 'id')->all();

        $sizes = Size::pluck('name', 'id')->all();
        

        return view('back.product.create', ['categories' => $categories,'sizes' => $sizes]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // gestion du formulaire de creaton du produit
        $this->validate($request, [
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string',
            'price' => 'required',
            'sizes.*' => 'integer',
            'product_visible' => 'required',
            'state_product' => 'required',
            'reference' => 'required|string||min:16|max:16',
            'category_id' => 'integer'
        ]);

        //crée un produit si la validation du formulaire est correct
        $product=Product::create($request->all());
        //associe la categorie du produit et de la catégorie
        $product->category()->associate($request->category_id);
       
         //associe la taille d'un produit avec les tailles.
        $product->sizes()->attach($request->sizes);
        
        // recupere l'id de la catégorie du formulaire
        $category_id= $request->input('category_id');

        // recupere la catégorie en fonction de l'id
        $categories = Category::find($category_id);
        

        //on recupere si une image a été envoyé
        $im = $request->file('picture');


        if (!empty($im)) {
            //retourne le lien de l'image avec la catégorie
            $link = $request->file('picture')->store($categories->name);

            // mettre à jour la table picture pour le lien vers l'image dans la base de données
            $product->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title
            ]);
        }
        //sauvegarde les produits.
        $product->save();
        return redirect()->route('adminProduct')->with('message', 'Produit bien ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        //retourne la view pour modifier un produit avec la listes des categories et la listes des tailles
    public function edit($id)
    {
        //recupere un produit
        $product = Product::find($id);

        //recupere les categories
        $categories = Category::pluck('name', 'id')->all();
        
        //recuper les tailles
        $sizes = Size::pluck('name', 'id')->all();


        //retourne la view pour modifier un produit avec en arguments le produit, les categories et les tailles.
        return view('back.product.edit', compact('product', 'categories','sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //// gestion du formulaire de modifier du produit
        $this->validate($request, [
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string',
            'price' => 'required',
            'sizes.*' => 'integer', // pour vérifier un tableau d'entiers il faut mettre sizes.*
            'product_visible' => 'required',
            'state_product' => 'required',
            'reference' => 'required|string||min:16|max:16',
            'category_id' => 'integer'
        ]);


        //recupere un produit

        $product = Product::find($id); // associé les fillables

        
        //recupere la categorie selectionné
        $category_id= $request->input('category_id');

        //modifie le produit
        $product->update($request->all());

        //modifie les tailles du produit
        $product->sizes()->sync($request->sizes);

        //recupere la categorie selectionné
        $categories = Category::find($category_id);

        //modifie la catégorie 
        foreach ($product as $prod){
            DB::table('products')
                    ->where('id', $id)
                    ->update(['category_id' => $category_id]);
        }
        
            
    

        
        // recupere l'image
        $im = $request->file('picture');

         // si on associe une image à un produit
         if (!empty($im)) {
 
            $link = $request->file('picture')->store($categories->name);

            // suppression de l'image si elle existe 
            if(count(array($product->picture))>0){

        
                $product->picture()->update([
                    'link' => $link,
                    'title' => $request->title_image?? $request->title
                ]);
            }else{

            
            // mettre à jour la table picture pour le lien vers l'image dans la base de données
            $product->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title
            ]);

            }
            
        }
        //produit sauvegardé
        $product->save();
        return redirect()->route('adminProduct')->with('message', 'Produit bien modifié');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //produit supprimé
        Product::destroy($id);



        
        // retourne la view
        return redirect()->route('adminProduct')->with('message', 'Le produit à bien été supprimé.');
    }
}
