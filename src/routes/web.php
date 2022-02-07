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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    /**===新規登録=== **/
    Route::get('/item','ItemController@index');
    Route::get('/item/show/{itemId}','ItemController@show');

    /**===新規登録=== **/
    Route::get('/regist_item','RegistItemController@index');
    Route::post('/regist_item','RegistItemController@store');




});


