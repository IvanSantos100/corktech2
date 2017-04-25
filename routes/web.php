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


Route::get('/edit', 'HomeController@edit')->name('edit');
Route::get('/editpassword', 'HomeController@editpassword')->name('editpassword');
Route::put('/update', 'HomeController@update')->name('update');
Route::put('/updatepassword', 'HomeController@updatepassword')->name('updatepassword');

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

    Route::name('clientes.index')->get('clientes','ClientesController@index');
    Route::group(['middleware' => 'check-permission:nacional'], function(){
        Route::resource('clientes', 'ClientesController', ['except' => 'index']);
    });

    Route::resource('pedidos', 'PedidosController');
    Route::resource('pedidosencerrados', 'PedidosEncerradosController');
    Route::get('pedidosencerrados/{pedido}/itenspedido', 'PedidosEncerradosController@itenspedido')->name('pedidosencerrados.itenspedido');
    Route::get('pedidosencerrados/{pedido}/{produto}/details', 'PedidosEncerradosController@details')->name('pedidosencerrados.details');

    Route::get('itenspedido/{pedido}', 'ItensPedidoController@index')->name('itenspedido.index');
    Route::get('itenspedido/{pedido}/produtos', 'ItensPedidoController@listarProdutos')->name('itenspedido.produtos');
    Route::post('itenspedido/{pedido}/produtos', 'ItensPedidoController@addProdudo')->name('itenspedido.produtos');
    Route::get('itenspedido/{pedido}/produto/{produto}', 'ItensPedidoController@editProdudo')->name('itenspedido.edit');
    Route::put('itenspedido/{pedido}/produto/{produto}', 'ItensPedidoController@updateProdudo')->name('itenspedido.update');
    Route::delete('itenspedido/{pedido}/produto/{produto}', 'ItensPedidoController@deleteProduto')->name('itenspedido.produto.delete');

    //Route::resource('itenspedidos', 'ItensPedidosController');

    Route::name('usuarios.index')->get('usuarios','UsuariosController@index');
    Route::group(['middleware' => 'check-permission:nacional'], function() {
        Route::get('usuarios/{usuario}/editpassword','UsuariosController@editpassword')->name('usuarios.editpassword');
        Route::put('usuarios/{usuario}/updatepassword', 'UsuariosController@updatepassword')->name('usuarios.updatepassword');
        Route::resource('usuarios', 'UsuariosController', ['except' => 'index']);
    });
});

