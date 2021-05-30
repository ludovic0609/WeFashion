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



// ici écrivez votre route

//route pour la recherche
Route::get('search', 'FrontController@search')->name('search');

//route pour afficher les produits
Route::get('/', 'FrontController@index')->name('homepage');

    
//route pour afficher les produits en solde
Route::get('discount', 'FrontController@indexDiscount')->name('discount');

//route pour afficher les produits par category
Route::get('category/{slug}', 'FrontController@indexCategory')->name('category');

//route pour gerer les produits
Route::resource('admin/product', 'ProductController');

//route pour gerer les categories
Route::resource('admin/category', 'CategoryController');


Route::get('admin/product', 'ProductController@index')->name('adminProduct');


Route::get('admin/category', 'CategoryController@index')->name('adminCategory');

//route pour gerer un produit
Route::get('product/{slug}', 'FrontController@show')->name('product');




Auth::routes(); // routes pour le login Laravel avec la commande php artisan make:auth

Route::resource('admin', 'Productcontroller');

    

Route::resource('admin', 'ProductController')->middleware('auth'); // middleware auth vérification d'un user authentifié
  










