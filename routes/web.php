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

Route::get('/', 'LorionController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/','Admin\AdminController@index');
    Route::get('domaine','Admin\AdminController@show_domaine')->name('domaine');
    Route::post('domaine','Admin\AdminController@add_domaine');
    Route::get('delete_domaine/{id}','Admin\AdminController@delete_domaine');
    Route::post('update_domaine/{id}','Admin\AdminController@update_domaine');

    Route::get('sous_domaine','Admin\AdminController@show_sous_domaine')->name('sous_domaine');
    Route::post('sous_domaine','Admin\AdminController@add_sous_domaine');
    Route::get('delete_/{id}','Admin\AdminController@delete_sous_domaine');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/produit','Admin\ProduitController@index');
    Route::post('/produit','Admin\ProduitController@add_produit' );
    Route::get('/delete_produit/{id}','Admin\ProduitController@delete');
    Route::post('/update_produit/{id}','Admin\ProduitController@update');
    Route::get('/edit/{id}','Admin\ProduitController@edit');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
