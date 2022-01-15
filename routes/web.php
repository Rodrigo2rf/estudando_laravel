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