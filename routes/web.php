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

Route::get('/', 'FrontController@index');

Route::get('product/{id}', 'FrontController@show')->where(['id' => '[0-9]+']);

Route::get('category/{id}', 'FrontController@showByCategory')->where(['id' => '[0-9]+']);

Route::get('test/{id}', function ($id) {

    $search = $word1 . " " . $word2;

    return App\Product::find($id);
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/product', 'ProductController')->middleware('auth');
