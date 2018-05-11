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
    return redirect('/login');
});

Route::get('/teste', 'testeController@index');

Auth::routes();
//As rotas a seguir necessitam de login para serem acessadas
Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/home', 'HomeController@index')->name('home');
    //ROTAS CORREIO
    Route::get('/correio', 'RemessasController@index');

    Route::get('/correio/{remessa}', 'RemessasController@show');

    Route::get('/remessa', 'RemessasController@store');

    Route::get('/trocarSenha', function () {
        return view('auth.senha');
    });

    Route::get('/item/remover/{item}', 'ItemsController@destroyCart');

    //ROTAS MATERIAL
    Route::get('/material/lista', 'MaterialController@index');

    Route::get('/materialAjax', 'MaterialController@buscaMaterial');

    Route::get('/material/novoMaterial', 'MaterialController@adicionarMaterial');

    Route::get('/material/novoPedido', 'PedidoController@novoPedido');

    Route::get('/pedidoAjax', 'PedidoController@buscaMaterial');

    Route::get('/carrinhoAjax', 'PedidoController@carrinho');

    Route::get('/removeAjax', 'PedidoController@destroyCarrinho');

    Route::get('/material/{material}', 'MaterialController@editarMaterial');

    Route::get('/material/busca', 'MaterialController@buscaMaterial');

    Route::get('/material', 'PedidoController@index');

    Route::get('/material/pedido/{pedido}', 'PedidoController@show');
    // POST ROUTES
    Route::post('/user', 'UserController@store');
    
    Route::post('/pedido', 'PedidoController@store');

    Route::post('/material', 'MaterialController@store');

    Route::post('/material/{material}', 'MaterialController@update');

    Route::post('/material/delete/{material}', 'MaterialController@delete');

    Route::post('/item', 'ItemsController@store');

    Route::post('/trocarSenha', 'UserController@trocarSenha');

    Route::post('/remessa/delete/{remessa}', 'RemessasController@delete');

    Route::post('/pedido/delete/{pedido}', 'PedidoController@delete');

    Route::post('/correio/busca', 'RemessasController@busca');
});
