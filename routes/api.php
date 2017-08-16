<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'Allapi', 'namespace'=>'APIs'],function(){

    Route::get('/','ApiPanelController@index');
    Route::get('/categories','ApiPanelController@categories');
    Route::get('/subcategories','ApiPanelController@subcategories');
    Route::get('/news','ApiPanelController@news');
    Route::get('/register-user-form','ApiPanelController@registerForm');
    Route::get('/login-user-form','ApiPanelController@loginForm');


});

Route::group(['namespace'=>'APIs'],function(){


    Route::post('/register-app-user','UserController@registerAppUser');
    Route::post('/login-app-user','UserController@loginAppUser');
    Route::get('/all-languages','WebServicesController@allLanguages');
    Route::post('/login','WebServicesController@login');
    Route::get('/categories','WebServicesController@categories');
    Route::post('/subcategories','WebServicesController@subcategories');
    Route::post('/news','WebServicesController@news');

});

