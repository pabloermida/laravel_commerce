<?php

Route::group(['prefix'=>'admin/categories'], function() {
    Route::get('/', 'AdminCategoriesController@index');
    Route::post('/', 'AdminCategoriesController@store');
    Route::get('create', 'AdminCategoriesController@create');
});

Route::group(['prefix'=>'admin/products'], function() {
    Route::get('/', 'AdminProductsController@index');
    Route::post('/', 'AdminProductsController@store');
    Route::get('create', 'AdminProductsController@create');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('index','WelcomeController@index');

Route::get('exemplo','WelcomeController@exemplo');