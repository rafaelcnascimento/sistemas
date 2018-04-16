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

Route::get('/testeAjax', 'MaterialController@buscaMaterial');

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

    Route::get('/correio/{remessa}', 'RemessasController@show');

    Route::get('/trocarSenha', function () { return view('auth.senha'); });

    Route::get('/item/remover/{item}', 'ItemsController@destroy');

    //ROTAS MATERIAL
    Route::get('/material/lista', 'MaterialController@index');  

    Route::get('/material/novoMaterial', 'MaterialController@adicionarMaterial');

    Route::get('/material/{id}', 'MaterialController@editarMaterial'); 

    Route::get('/material/busca', 'MaterialController@buscaMaterial'); 
    // POST ROUTES
    Route::post('/material', 'MaterialController@store');

    Route::post('/material/{id}', 'MaterialController@update');

    Route::post('/material/delete/{id}', 'MaterialController@delete');

    Route::post('/item', 'ItemsController@store');

    Route::post('/trocarSenha', 'UserController@trocarSenha');

    Route::post('/user', 'UserController@store');

    Route::post('/remessa/delete/{remessa}', 'RemessasController@delete');

    Route::post('/correio/busca', 'RemessasController@busca');
});





