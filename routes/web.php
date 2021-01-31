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

/** login and register user */
Route::get('/', 'AuthController@index')->name('index');
Route::get('/?q={id}&brand={id2}', 'AuthController@index')->name('index.search');
Route::get('login', 'AuthController@login')->name('login');
Route::post('login/do', 'AuthController@doLogin')->name('doLogin');
Route::post('register', 'UserController@register')->name('register');

/** contact */
Route::get('fale-conosco', 'ContactController@index')->name('contact');
Route::resource('contact','ContactController');


Route::group(['middleware' => ['auth']], function() {

    /** cart */
    Route::get('carrinho/adicionar/{id}', 'CartController@addCart')->name('cart.addCart');
    Route::get('carrinho/add/{id}', 'CartController@add')->name('cart.add');
    Route::get('carrinho/sub/{id}', 'CartController@sub')->name('cart.sub');
    Route::get('carrinho', 'CartController@show')->name('cart.show');
    Route::get('carrinho/adicionar/carrinho/{id}', 'CartController@addCartWish')->name('cart.addCartWish');

    /** wish */
    Route::get('lista-desejo/adicionar/{id}', 'CartController@addNewWish')->name('wish.addNewWish');
    Route::get('lista-desejo/add/{id}', 'CartController@addWish')->name('wish.addWish');
    Route::get('lista-desejo/sub/{id}', 'CartController@subWish')->name('wish.subWish');
    Route::get('lista-desejo', 'CartController@wish')->name('wish.wish');
    
    /** sale */
    Route::post('venda', 'SaleController@addSale')->name('sale.addSale');
    Route::get('admin/vendas', 'SaleController@index')->name('admin.sale');

    /** product */
    Route::get('admin/produtos', 'ProductController@admin')->name('admin');
    Route::get('admin/produtos/cadastrar', 'ProductController@create')->name('admin.product.create');
    Route::get('admin/produtos/editar/{id}', 'ProductController@edit')->name('admin.product.edit');
    Route::get('admin/produtos/excluir/{id}', 'ProductController@destroy')->name('admin.product.destroy');
    Route::resource('product','ProductController');

    /** brand */
    Route::get('admin/marcas', 'BrandController@index')->name('admin.brand');
    Route::get('admin/marcas/cadastrar', 'BrandController@create')->name('admin.brand.create');
    Route::get('admin/marcas/editar/{id}', 'BrandController@edit')->name('admin.brand.edit');
    Route::get('admin/marcas/excluir/{id}', 'BrandController@destroy')->name('admin.brand.destroy');
    Route::resource('brand','BrandController');

    /** sales */

    /** message */
    Route::get('admin/mensagens', 'ContactController@menssage')->name('admin.menssage');

    /** user */
    Route::get('admin/usuario', 'UserController@index')->name('admin.user');
    Route::get('admin/usuario/cadastrar', 'UserController@create')->name('admin.user.create');
    Route::get('admin/usuario/editar/{id}', 'UserController@edit')->name('admin.user.edit');
    Route::get('admin/usuario/excluir/{id}', 'UserController@destroy')->name('admin.user.destroy');
    Route::put('admin/usuario/update/{id}', 'UserController@updateAdmin')->name('admin.user.updateAdmin');
    Route::get('minha-conta', 'UserController@home')->name('user.home');
    Route::resource('user','UserController');

});

/** logout */
Route::get('logout', 'AuthController@logout')->name('logout');
