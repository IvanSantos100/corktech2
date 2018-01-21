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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {  //, 'check-permission:nacional|distribuidora|revenda'
    Route::group(['middleware' => 'check-permission:nacional'], function () {
        Route::resource('classes', 'ClassesController');
        Route::resource('estampas', 'EstampasController');
        Route::resource('tipoprodutos', 'TipoProdutosController');
        Route::resource('centrodistribuicoes', 'CentroDistribuicoesController');
    });

    Route::resource('produtos', 'ProdutosController');

    Route::name('estoques.index')->get('estoques', 'EstoquesController@index');
    Route::group(['middleware' => 'check-permission:nacional'], function () {
        Route::resource('estoques', 'EstoquesController', ['except' => ['index', 'create', 'store', 'update', 'store', 'destroy']]);
    });
    Route::get('estoques/{estoque}/details', 'EstoquesController@details')->name('estoques.details');

    Route::name('clientes.index')->get('clientes', 'ClientesController@index');
    Route::resource('clientes', 'ClientesController', ['except' => 'index']);


    Route::resource('pedidos', 'PedidosController');
    Route::get('pedidos/{pedido}/status', 'PedidosController@status')->name('pedidos.status');
    Route::get('pedidos/cliente/{cliente}', 'PedidosController@cliente')->name('pedidos.cliente');
    Route::get('pedidos/itempedido/{pedido}', 'PedidosController@itempedido')->name('pedidos.itempedido');


    /*
    Route::resource('pedidosencerrados', 'PedidosEncerradosController');
    Route::get('pedidosencerrados/{pedido}/itempedido', 'PedidosEncerradosController@itempedido')->name('pedidosencerrados.itempedido');
    Route::get('pedidosencerrados/{pedido}/{produto}/details', 'PedidosEncerradosController@details')->name('pedidosencerrados.details');
    */

    Route::group(['prefix' => 'pedidosencerrados/{status}', 'as' => 'pedidosencerrados.'], function () {
        Route::get('index', 'PedidosEncerradosController@index')->name('index');
        Route::get('itempedido/{pedido}', 'PedidosEncerradosController@itempedido')->name('itempedido');
        Route::get('cliente/{cliente}', 'PedidosEncerradosController@cliente')->name('cliente');
        Route::get('itempedido/{pedido}/details/{produto}', 'PedidosEncerradosController@details')->name('details');
        Route::get('itempedido/{pedido}/extornar', 'PedidosEncerradosController@extornar')->name('extornar');
    });

    Route::get('itempedido/{pedido}/index', 'ItemPedidoController@index')->name('itempedido.index');
    Route::get('itempedido/{pedido}/produtos', 'ItemPedidoController@listarProdutos')->name('itempedido.produtos');
    Route::post('itempedido/{pedido}/produtos', 'ItemPedidoController@addProdudo')->name('itempedido.produtos');
    Route::put('itempedido/{pedido}/produtos', 'ItemPedidoController@update')->name('itempedido.update');
    Route::get('itempedido/{pedido}/details/{produto}', 'ItemPedidoController@details')->name('itempedido.details');
    Route::delete('itempedido/{pedidoId}/produto/{itempedido}/delete', 'ItemPedidoController@deleteProduto')->name('itempedido.produto.delete');

    //Route::resource('itempedidos', 'itempedidosController');

    Route::name('usuarios.index')->get('usuarios', 'UsuariosController@index');
    Route::group(['middleware' => 'check-permission:nacional'], function () {
        Route::get('usuarios/{usuario}/editpassword', 'UsuariosController@editpassword')->name('usuarios.editpassword');
        Route::put('usuarios/{usuario}/updatepassword', 'UsuariosController@updatepassword')->name('usuarios.updatepassword');
        Route::resource('usuarios', 'UsuariosController', ['except' => 'index']);
    });

    Route::get('user/{id}', function () {
        \Auth::loginUsingId(\Request::route()->id);
        return redirect('home');
    });
});
