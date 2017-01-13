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



Route::get('/mention', 'FrontController@indexMention');

Route::get('/lycee', 'FrontController@indexLycee');

Route::get('/posts',  'FrontController@indexPost');

Route::get('/post/{id}', 'FrontController@show');


Route::get('/contact', 'FrontController@indexContact');


Auth::routes();

Route::get('/', 'FrontController@index');

Route::get('/teacher', 'TeacherController')->middleware('teacher');

Route::resource('/teacher/posts', 'PostController');
Route::resource('/teacher/fiches/questions', 'QuestionController');
// Route::resource('/teacher/fiches/choices', 'ChoicesController');
Route::get('/teacher/fiches/choices/{id}', 'ChoiceController@edit');
Route::put('/teacher/fiches/choices/{id}', 'ChoiceController@update');
Route::resource('/teacher/fiches', 'FichesController');


Route::get('/student', 'StudentController@index');
Route::get('/student/qcm', 'StudentController@indexQCM');
Route::get('/student/qcm/{id}', 'StudentController@show');
Route::put('/student/qcm/{id}', 'StudentController@update');
