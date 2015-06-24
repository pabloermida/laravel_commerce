<?php

Route::get('admin/categories', 'AdminCategoriesController@index');
Route::get('admin/products', 'AdminProductsController@index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('index','WelcomeController@index');

Route::get('exemplo','WelcomeController@exemplo');