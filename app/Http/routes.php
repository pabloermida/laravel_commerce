<?php

Route::pattern('id', '[0-9]+');

Route::group(['prefix'=>'admin'], function() {
    Route::group(['prefix'=>'categories'], function() {
        Route::get('/', 'AdminCategoriesController@index');
        Route::post('/', 'AdminCategoriesController@store');
        Route::get('create', 'AdminCategoriesController@create');
        Route::get('show/{id}', 'AdminCategoriesController@show');
        Route::get('update/{id}', 'AdminCategoriesController@update');
        Route::get('destroy/{id}', 'AdminCategoriesController@destroy');
    });

    Route::group(['prefix'=>'products'], function() {
        Route::get('/', 'AdminProductsController@index');
        Route::post('/', 'AdminProductsController@store');
        Route::get('create', 'AdminProductsController@create');
        Route::get('show/{id}', 'AdminProductsController@show');
        Route::get('update/{id}', 'AdminProductsController@update');
        Route::get('destroy/{id}', 'AdminProductsController@destroy');
    });
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('index','WelcomeController@index');

Route::get('exemplo','WelcomeController@exemplo');