<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::match(["GET", "POST"], "/register", function() {
    return redirect("/login");
})->name("register");


Route::get('/home', 'HomeController@index')->name('home');
Route::resource("users", "UserController");

Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch')->name('categories.search');
Route::delete('/categories/{id}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');
Route::resource("categories", "CategoryController");

Route::get('/products/trash', 'ProductController@trash')->name('products.trash');
Route::post('/products/{id}/restore', 'ProductController@restore')->name('products.restore');
Route::delete('/products/{id}/delete-permanent', 'ProductController@deletePermanent')->name('products.delete-permanent');
Route::resource('products', 'ProductController');

Route::resource('orders', 'OrderController');
