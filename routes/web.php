<?php

use App\Product;
use App\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ici écrivez votre route

Route::get('search', 'FrontController@search')->name('search');

    Route::get('/', 'FrontController@index')->name('homepage');

    
    
    Route::get('discount', 'FrontController@indexDiscount')->name('discount');

    Route::get('category/{slug}', 'FrontController@indexCategory')->name('category');

    //Route::get('admin/product', 'ProductController@index')->name("admin/product");

    Route::resource('admin/product', 'ProductController');

    Route::resource('admin/category', 'CategoryController');

    Route::get('admin/product', 'ProductController@index')->name('adminProduct');
   
    Route::get('admin/category', 'CategoryController@index')->name('adminCategory');


    Route::get('product/{slug}', 'FrontController@show')->name('product');

    Route::get('/home', 'HomeController@index')->name('home');




    /*
    Route::put('admin/product/create', 'ProductController@create')->name("product.create");
    Route::post('admin/product/edit/{slug}', 'ProductController@edit')->name("product.edit");
    Route::delete('admin/product/destroy/{slug}', 'ProductController@destroy')->name("product.destroy");
    */


    Auth::routes(); // routes pour le login Laravel avec la commande php artisan make:auth

    Route::resource('admin', 'Productcontroller');

    

    Route::resource('admin', 'ProductController')->middleware('auth'); // middleware auth vérification d'un user authentifié
  




    /*Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'ProductController@index')->name('home');
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
});*/





//Route::get('product/{id}', 'FrontController@show');


// retourne l'ensemble des produits

/*
Route::get('products', function(){

    
    return App\Product::all();
    
    });

    // retourne un produit en fonction de son id
Route::get('products/{id}', function($id){
    return App\Product::find($id);
    });

        // retourne un produit pour homme
Route::get('categorie/homme', function(){
    return App\Product::where('categorie_id','1')->get();
    });

        // retourne un produit pour femme
Route::get('categorie/femme', function(){
    return App\Product::where('categorie_id','2')->get();
    });
*/








