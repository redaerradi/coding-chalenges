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
Route::delete('category/destroy', 'CategoryController@destroy');
Route::delete('product/destroy', 'ProductController@destroy');

Route::resource('product', 'ProductController');
Route::resource('category', 'CategoryController');
