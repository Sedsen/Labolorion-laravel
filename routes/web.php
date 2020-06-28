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
Route::get('/show/{id}', 'LorionController@show_produit');
Route::get('/show_liste/{sous_domaine_id}', 'LorionController@show_liste_sous_domaine');
Route::get('/search', 'LorionController@search');
Route::get('/services', 'LorionController@afficher_services');
Route::get('/presentation', 'LorionController@afficher_presentation');
Route::get('/contact', 'LorionController@afficher_contact');
Route::get('/cart', 'LorionController@afficher_cart');
Route::post('/cart/{id}', 'LorionController@add_cart');
Route::get('/remove_cart/{id}', 'LorionController@delete_cart');
Route::get('/remove_all', 'LorionController@delete_all_cart');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'Admin\AdminController@index')->middleware('admin');
    Route::get('domaine', 'Admin\AdminController@show_domaine')->name('domaine');
    Route::post('domaine', 'Admin\AdminController@add_domaine');
    Route::get('delete_domaine/{id}', 'Admin\AdminController@delete_domaine');
    Route::post('update_domaine/{id}', 'Admin\AdminController@update_domaine');

    Route::get('sous_domaine', 'Admin\AdminController@show_sous_domaine')->name('sous_domaine');
    Route::post('sous_domaine', 'Admin\AdminController@add_sous_domaine');
    Route::get('delete_/{id}', 'Admin\AdminController@delete_sous_domaine');
    Route::post('update_sous_domaine/{id}', 'Admin\AdminController@update_sous_domaine');

    Route::get('show_users', 'Admin\AdminController@show_users');
    Route::post('show_users', 'Admin\AdminController@add_users');
    Route::get('delete_user/{id}', 'Admin\AdminController@delete_user');

    Route::get('entreprise', 'Admin\AdminController@voir_entreprise');
    Route::post('entreprise', 'Admin\AdminController@update_entreprise');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/produit', 'Admin\ProduitController@index');
    Route::post('/produit', 'Admin\ProduitController@add_produit');
    Route::get('/delete_produit/{id}', 'Admin\ProduitController@delete');
    Route::post('/update_produit/{id}', 'Admin\ProduitController@update');
    Route::get('/edit/{id}', 'Admin\ProduitController@edit');
});

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    /* Route::get('/{chat_id}','ChatController@index');
*/
    Route::get('view/{user_id}', 'ChatController@view_message');
    Route::post('view/{user_id}', 'ChatController@add_admin_message');
    Route::get('/{admin_id}', 'ChatController@index');
    Route::get('/view_', 'ChatController@view_user_message');
    Route::post('/', 'ChatController@add_user_message');
});


Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');

Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'Twitter|Facebook');
Route::get('/login/{social/callback}', 'Auth\LoginController@handleProviderCallback')->where('social', 'Twitter|Facebook');

Auth::routes(); //['verify' => false]

Route::get('/home', 'HomeController@index')->name('home');
