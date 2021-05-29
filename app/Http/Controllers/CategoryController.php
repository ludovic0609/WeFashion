<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use DB;

class CategoryController extends Controller
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
        $categories = Category::paginate($this->paginate);
        
    

        return view('back.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('back.category.create');
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
            'name' => 'required|string'
        ]);

        Category::create($request->all());

        return redirect()->route('adminCategory')->with('message', 'Catégorie bien ajouté');
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
        $category = Category::find($id);

     
        

        return view('back.category.edit', compact('category'));
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
            'name' => 'required|string'
        ]);

        $category = Category::find($id); // associé les fillables

        $category->update($request->all());

        return redirect()->route('adminCategory')->with('message', 'Catégorie bien modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        //$products = Product::pluck('category_id')->all();
        
        //$id=$category->id;
        
        

        /*foreach ($products as $product){
            DB::table('products')
                    ->where('category_id', $id)
                    ->update(['category_id' => NULL]);
        }*/

        $category->delete();


        
        



        //Category::destroy($id);



        


        

        return redirect()->route('adminCategory')->with('message', 'La catégorie à bien été supprimé.');
    }
}
