<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Picture;
use DB;

use Storage;

class ProductController extends Controller
{

    protected $paginate = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::paginate($this->paginate);
        
        $categories = Category::all();
        
        

        return view('back.product.index', ['products' => $products,'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();
        

        return view('back.product.create', ['categories' => $categories]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        
        
        $this->validate($request, [
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string',
            'price' => 'required',
            'size' => 'required|string',
            'product_visible' => 'required',
            'state_product' => 'required',
            'reference' => 'required|string||min:16|max:16',
            'category_id' => 'integer'
        ]);

        

        //dd($request->category_id);
        $product=Product::create($request->all());
        
        $product->category()->associate($request->category_id);
       
        
        
        $category_id= $request->input('category_id');

        $categories = Category::find($category_id);
        

        
        $im = $request->file('picture');

        if (!empty($im)) {
            
            $link = $request->file('picture')->store($categories->name);

            // mettre à jour la table picture pour le lien vers l'image dans la base de données
            $product->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title
            ]);
        }
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
    public function edit($id)
    {
        //
        $product = Product::find($id);

        $categories = Category::pluck('name', 'id')->all();
        



        return view('back.product.edit', compact('product', 'categories'));
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
        //
        $this->validate($request, [
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string',
            'price' => 'required',
            'size' => 'required|string',
            'product_visible' => 'required',
            'state_product' => 'required',
            'reference' => 'required|string||min:16|max:16',
            'category_id' => 'integer'
        ]);



        

        $product = Product::find($id); // associé les fillables

        

        $category_id= $request->input('category_id');

        $product->update($request->all());

        $categories = Category::find($category_id);

        foreach ($product as $prod){
            DB::table('products')
                    ->where('id', $id)
                    ->update(['category_id' => $category_id]);
        }
        
            
    

        

        $im = $request->file('picture');

         // si on associe une image à un book 
         if (!empty($im)) {
 
            $link = $request->file('picture')->store($categories->name);

            // suppression de l'image si elle existe 
            if(count(array($product->picture))>0){

                //Storage::disk('local')->delete($product->picture->link); // supprimer physiquement l'image
                //$product->picture()->delete(); // supprimer l'information en base de données
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


        Product::destroy($id);



        

        return redirect()->route('adminProduct')->with('message', 'Le produit à bien été supprimé.');
    }
}
