<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('recette', 'RecetteController');

Route::resource('ingredient', 'IngredientController', ['except' => ['show']]);

Route::resource('produit', 'ProduitController');

Route::resource('inventeur', 'InventeurController');

Route::resource('fournisseur', 'FournisseurController');

Route::get('utiliser/{id_rct}/{id_ngr}', 'UtiliserController@detruire');

Route::resource('utiliser', 'UtiliserController', ['except' => ['show']]);
