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

Route::post('auth/register', 'UserController@register');
Route::post('auth/login', 'UserController@login');
Route::group(['namespace'=>'APIs','middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserController@getAuthUser');
    Route::post('like-news', 'UserController@likeNews');
    Route::post('add-remove-favourite-news', 'UserController@addToFavouriteNews');
});

Route::group(['prefix'=>'Allapi', 'namespace'=>'APIs'],function(){

    Route::get('/','ApiPanelController@index');
    Route::get('/categories','ApiPanelController@categories');
    Route::get('/subcategories','ApiPanelController@subcategories');
    Route::get('/news','ApiPanelController@news');
    Route::get('/register-user-form','ApiPanelController@registerForm');
    Route::get('/login-user-form','ApiPanelController@loginForm');
    Route::get('/category-form','ApiPanelController@showCategoryForm');
    Route::get('/news-form','ApiPanelController@showNewsForm');
    Route::get('/related-news-form','ApiPanelController@showRelatedNewsForm');
    Route::get('/like-news-form','ApiPanelController@showLikeNewsForm');
    Route::get('/add-favourite-news-form','ApiPanelController@showAddFavrouiteNewsForm');


});

Route::group(['namespace'=>'APIs'],function(){


    Route::post('/register-app-user','UserController@registerAppUser');
    Route::post('/login-app-user','UserController@loginAppUser');
    Route::get('/all-languages','WebServicesController@allLanguages');
    Route::post('/categories-by-language','WebServicesController@categoryByLanguage');
    Route::post('/news','WebServicesController@getNews');
    Route::post('/related-news','WebServicesController@relatedNews');

    Route::get('/categories','WebServicesController@categories');
    Route::post('/subcategories','WebServicesController@subcategories');


});

