<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use DB;

class CategoryController extends Controller
{
    //nombre de categorie par pages.
    protected $paginate = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupere  toutes les catégories avec la pagination
        $categories = Category::paginate($this->paginate);
        
    
        // retourne la view avec  les catégories
        return view('back.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retourne la view back pour crée une catégorie
        return view('back.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // function pour crée une catégorie
    public function store(Request $request)
    {
        
        //Verification du formulaire
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

    //retourne la view pour editer une catégorie
    public function edit(Category $category)
    {
        return view('back.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // function pour modifier une catégorie
    public function update(Request $request, $id)
    {
        //verification des champs
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $category = Category::find($id); // associé les fillables

        $category->update($request->all()); // mets à jour la catégorie

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
        // suppression de la catégorie
        $category->delete();


        return redirect()->route('adminCategory')->with('message', 'La catégorie à bien été supprimé.');
    }
}
