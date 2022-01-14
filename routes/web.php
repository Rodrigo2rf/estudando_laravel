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
Route::get('/login',            'App\Http\Controllers\loginController@index')->name('login');
Route::get('/login/registrar',  'App\Http\Controllers\loginController@create');
Route::get('/login/logout',     'App\Http\Controllers\loginController@logout');

Route::post('/login',           'App\Http\Controllers\loginController@autenticar');
Route::post('/login/registrar',  'App\Http\Controllers\loginController@store');

Route::get('/admin', 'App\Http\Controllers\adminController@index')->name('admin');