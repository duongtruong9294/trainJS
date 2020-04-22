<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin'], function() {
    Route::group(['prefix' => 'login','middleware' => 'CheckLogedIn'], function() {
        Route::get('/','LoginController@getLogin');
        Route::post('/','LoginController@postLogin');

    });
    Route::get('logout','HomeController@getLogout');
    Route::group(['prefix' => 'admin','middleware' => 'CheckLogedOut'], function() {
        Route::get('home','HomeController@getHome');
        
        Route::group(['prefix' => 'category'],function() {
            Route::get('/','CategoryController@getCate');
        });
    });
});
