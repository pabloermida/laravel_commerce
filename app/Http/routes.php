<?php

Route::pattern('id', '[0-9]+');

Route::group(['prefix'=>'admin'], function() {
    Route::group(['prefix'=>'categories'], function() {
        Route::get('/', ['as'=>'categories','uses'=>'AdminCategoriesController@index']);
        Route::post('/', ['as'=>'categories.store','uses'=>'AdminCategoriesController@store']);
        Route::get('create', ['as'=>'categories.create', 'uses'=>'AdminCategoriesController@create']);
        Route::get('{id}/edit', ['as'=>'categories.edit', 'uses'=>'AdminCategoriesController@edit']);
        Route::put('{id}/update', ['as'=>'categories.update', 'uses'=>'AdminCategoriesController@update']);
        Route::get('{id}/destroy', ['as'=>'categories.destroy', 'uses'=>'AdminCategoriesController@destroy']);
    });

    Route::group(['prefix'=>'products'], function() {
        Route::get('/', ['as'=>'products','uses'=>'AdminProductsController@index']);
        Route::post('/', ['as'=>'products.store','uses'=>'AdminProductsController@store']);
        Route::get('create', ['as'=>'products.create', 'uses'=>'AdminProductsController@create']);
        Route::get('{id}/edit', ['as'=>'products.edit', 'uses'=>'AdminProductsController@edit']);
        Route::put('{id}/update', ['as'=>'products.update', 'uses'=>'AdminProductsController@update']);
        Route::get('{id}/destroy', ['as'=>'products.destroy', 'uses'=>'AdminProductsController@destroy']);

        Route::group(['prefix'=>'images'], function() {
            Route::get('{id}/product', ['as'=>'products.images','uses'=>'AdminProductsController@images']);
            Route::get('create/{id}/product', ['as'=>'products.images.create','uses'=>'AdminProductsController@createImage']);
            Route::post('store/{id}/product', ['as'=>'products.images.store','uses'=>'AdminProductsController@storeImage']);
            Route::get('destroy/{id}/image', ['as'=>'products.image.destroy', 'uses'=>'AdminProductsController@destroyImage']);
        });
    });


});

Route::get('/', 'StoreController@index');
Route::get('category/{id}', ['as'=>'store.category', 'uses'=>'StoreController@category']);
Route::get('product/{id}', ['as'=>'store.product', 'uses'=>'StoreController@product']);

Route::get('index','WelcomeController@index');

Route::get('exemplo','WelcomeController@exemplo');