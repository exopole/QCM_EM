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
    return view('front.welcome');
});

Route::get('/mention', function () {
    return view('front.legalMention');
});

Route::get('/lycee', function () {
    return view('front.lycee');
});

Route::get('/posts',  'FrontController@indexPost');

Route::get('/post/{id}/{title?}', 'FrontController@show');


Route::get('/contact', function () {
    return view('front.contact');
});


Auth::routes();

Route::get('/home', 'FrontController@index');
