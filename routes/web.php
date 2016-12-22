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

Route::get('/login', function () {
    return view('conexion_VBack');
});

Route::get('/mention', function () {
    return view('legalMention_VBack');
});

Route::get('/lycee', function () {
    return view('lycee_VBack');
});

Route::get('/posts',  'FrontController@index');

Route::get('/post', function () {
    return view('post_VBack');
});

Route::get('/contact', function () {
    return view('contact_VBack');
});

