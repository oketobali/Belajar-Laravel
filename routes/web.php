<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->prefix('home')->group(function(){
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductsController@index')->name('product');
        Route::get('/form/{id?}', 'ProductsController@productForm')->name('product.form');
        Route::post('/form/update', 'ProductsController@updateProduct')->name('product.update');
        Route::post('/form/create', 'ProductsController@createProduct')->name('product.create');
        //Route::put('form/update', 'ProductsController@updateProduct')->name('product.update');
        Route::get('/destroy/{id}', 'ProductsController@destroy')->name('product.destroy');
    });

    Route::get('/users', 'UserGeneratorController@showUsers')->name('users');
    Route::post('/users', 'UserGeneratorController@destroy')->name('users.destroy');
    Route::get('/product_logs', 'ProductLogsController@showLogs')->name('productLogs');
});

