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

    /**===商品ページ=== **/
    Route::get('/item/{param?}', 'ItemController@index')->name('item.index');
    Route::get('/item/show/{itemId}','ItemController@show');
    /**===商品画像のアップロード=== **/
    Route::post('/item/show/{itemId}', 'ImageController@upload')->name('item-image.upload');
    /**===カラー画像のアップロード=== **/
    Route::post('/item-image/show/{itemId}/{colorName}', 'ImageController@uploadColorImage')->name('item-color-image.upload');
    //商品画像詳細
    Route::get('/item-image/show/{itemId}', 'ImageController@show')->name('item-image.show');
    /**===商品更新=== **/
    Route::post('/item/update', 'ItemController@update')->name('item.update');
    /**===出品用CSVダウンロード=== **/
    Route::post('/item/csv-download/{mallIds?}', 'CsvDownloadController@downloadCsv')->name('item.csv-download');



    /**===新規登録=== **/
    Route::get('/regist_item','RegistItemController@index');
    Route::post('/regist_item','RegistItemController@store');

    /**===メーカー=== **/
    Route::get('/admin/maker', 'MakerController@index');
    Route::get('/admin/regist/maker', 'MakerController@create');
    Route::post('/admin/regist/maker', 'MakerController@store');




});


