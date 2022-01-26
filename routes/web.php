<?php

use Illuminate\Support\Facades\Route;

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

// Autenticação
Route::get('/login','App\Http\Controllers\loginController@index')->name('login');
Route::get('/login/registrar','App\Http\Controllers\loginController@create');
Route::get('/login/logout','App\Http\Controllers\loginController@logout');
Route::post('/login','App\Http\Controllers\loginController@autenticar');
Route::post('/login/registrar','App\Http\Controllers\loginController@store');

// Dashboard
Route::get('/dashboard','App\Http\Controllers\dashboardController@index')->name('dashboard');

// Admin
Route::get('/admin/cadastrarSupermercado','App\Http\Controllers\adminController@formSupermercado')->name('form_supermercado');
Route::post('/admin/cadastrarSupermercado','App\Http\Controllers\adminController@cadastrarSupermercado')->name('cadastrar_supermercado');
Route::get('/admin/editarSupermercado/{id}','App\Http\Controllers\adminController@formEditarSupermercado')->name('editar_supermercado');
Route::post('/admin/editarSupermercado/{id}','App\Http\Controllers\adminController@editarSupermercado')->name('editar_supermercado');

Route::delete('/admin/excluirSupermercado/{id}', 'App\Http\Controllers\adminController@excluirSupermercado')->name('excluir_supermercado');

Route::get('/admin/cadastrarFeira','App\Http\Controllers\adminController@formFeira')->name('cadastrar_feira');
Route::post('/admin/cadastrarFeira','App\Http\Controllers\adminController@cadastrarFeira')->name('cadastrar_feira');

Route::get('/admin/informacoesFeira/{id}','App\Http\Controllers\adminController@informacoesFeira')->name('informacoes_feira');

Route::post('/admin/informacoesFeira/{id}','App\Http\Controllers\adminController@editarFeira')->name('informacoes_feira');

// Adicionar produto ao carrinho
// Route::post('/admin/informacoesFeira/{id}','App\Http\Controllers\adminController@adicionarProdutoAoCarrinho')->name('adicionar_produtos_ao_carrinho');

Route::delete('/admin/excluirItemCarrinho/{item_id}/{info_id}', 'App\Http\Controllers\adminController@excluirItemCarrinho')->name('excluir_item_carrinho');

// Route::get('admin/invoice/create','App\Http\Controllers\adminController@create');

Route::post('admin/api/produto','App\Http\Controllers\adminController@getAutocompleteData')->name('autocomplete_produtos'); 