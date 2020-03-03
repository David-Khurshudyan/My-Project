<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('welcome');
});

Route::get('welcome/{page?}', 'PostController@index')->where(['page' => '[0-9]+']);
Route::get('/post/{postID}', 'CommentController@index')->where(['id' => '[0-9]+']);
Route::post('/post/{postID}/comment', 'CommentController@addComment')->where(['id' => '[0-9]+']);

Route::get('delete/{id}', 'PostController@destroy')->where(['id' => '[0-9]+']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'PostController@store')->name('create.post');

Route::get('/about_us', function(){
	return view('author');
});
