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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function(){  //, 'check-permission:nacional|distribuidora|revenda'
    Route::group(['middleware' => 'check-permission:nacional'], function() {
        Route::resource('classes', 'ClassesController');
        Route::resource('estampas', 'EstampasController');
        Route::resource('tipoprodutos', 'TipoProdutosController');
        Route::resource('centrodistribuicoes', 'CentroDistribuicoesController');
    });

    Route::resource('produtos', 'ProdutosController');

    Route::name('estoques.index')->get('estoques', 'EstoquesController@index');
    Route::group(['middleware' => 'check-permission:nacional'], function() {
        Route::resource('estoques', 'EstoquesController', ['except' => 'index']);
    });
    Route::get('estoques/{estoque}/details', 'EstoquesController@details')->name('estoques.details');

    Route::name('clientes.index ')->get('clientes','ClientesController@index');
    Route::group(['middleware' => 'check-permission:nacional'], function(){
        Route::resource('clientes', 'ClientesController', ['except' => 'index']);
    });

    Route::resource('pedidos', 'PedidosController');
    Route::resource('itenspedidos', 'ItensPedidosController');

    Route::name('usuarios.index ')->get('usuarios','UsuariosController@index');
    Route::group(['middleware' => 'check-permission:nacional'], function() {
        Route::resource('usuarios', 'UsuariosController', ['except' => 'index']);
    });
});

