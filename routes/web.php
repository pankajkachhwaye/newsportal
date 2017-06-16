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
    return view('auth.login');

});

Route::get('/home','HomeController@index');
Route::get('/form','FormController@index');
Route::post('/get_data','FormController@get_data');
Route::get('/apis','APIs\ApiPanelController@index');
Route::get('/apis/test','APIs\ApiViewController@test');

Route::get('/merchant','MerchantController@registrction');
Route::post('/merchant/store','MerchantController@store');
Route::get('/fileupload/view','MerchantController@fileupload');
Route::post('/fileupload/store','MerchantController@fileupload_store');


//Route::get('/apis',function(){
//    return "hello";
//});
//
//Route::group(['prefix' => 'panel','namespace' => 'APIs'], function () {
//    Route::get('/','AdminController@categoryAtrributeIndex');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
