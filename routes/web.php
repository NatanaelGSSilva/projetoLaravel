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


Route::get('/', 'HomeController');
Route::view('/teste', 'teste');
Route::get('/login','Auth\LoginController@index')->name('login');
Route::post('/login','Auth\LoginController@authenticate');
Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/logout','Auth\LoginController@logout')->name('logout');



/**
 * GET - /todo - index - todo.index - LISTA OS ITENS
 * GET - /todo/create - create -todo.create FORM DE CRIAÇAO
 * POST - /todo - store -todo.store RECEBER OS DADOS DO ADD ITEM
 * GET - /todo/{id} - show  - todo.show - ITEM INDIVIDUAL
 * GET - /todo/{id}/edit - edit - todo.edit - FORM DE EDIÇÃO
 * PUT- /todo/{id} - update - todo.update - RECEBER OS DADOS E UPDATE ITEM
 * DELETE - /todo/{id} - destroy - todo.destroy - DELETAR O ITEM
 * 
 */

Route::resource('todo','TodoController');

Route::prefix('/tarefas')->group(function(){
    Route::get('/','TarefasController@list')->name('tarefas.list'); // Listagem de tarefas

    Route::get('add','TarefasController@add')->name('tarefas.add'); // Tela de adição de nova tarefa
    Route::post('add','TarefasController@addAction'); // ação de adição de nova tarefa

    Route::get('edit/{id}','TarefasController@edit')->name('tarefas.edit'); // tela de edição
    Route::post('edit/{id}','TarefasController@editAction'); // ação de edição

    Route::get('delete/{id}','TarefasController@del')->name('tarefas.del');//Ação de deletar

    Route::get('marcar/{id}','TarefasController@done')->name('tarefas.done'); //marcar resolvido/não

});


Route::prefix('/config')->group(function(){
    Route::get('/','Admin\ConfigController@index')->name('config.index');
    Route::post('/','Admin\ConfigController@index');

    Route::get('info','Admin\ConfigController@info');

    Route::get('permissoes','Admin\ConfigController@permissoes');
    
});

Route::fallback(function(){
    return view('404');
});

// Route:: get('/config',function(){
//     // $link = route('info');
//     // echo "Link ".$link;
//     // return redirect()->route('permissoes');
//      return view('config');
// });
// Route:: get('/config/info',function(){
//      echo "Configurações INFO";
// })->name('info');
// Route:: get('/config/permissoes',function(){
//      echo "Configurações Permossões";
// })->name('permissoes');




// Route:: get('/noticia/{slug}',function($slug){
// echo "Titulo ".$slug;
// });

// Route::get('/user/{name}', function($name){
//     echo "Mostrando Usúario de Nome ".$name;
// })->where('name','[a-z]+');

// Route::get('/user/{id}', function($id){
//     echo "Mostrando Usúario ID ".$id;
// });





