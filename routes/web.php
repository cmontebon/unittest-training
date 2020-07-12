<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();
Route::get('/', function() {
    return redirect('/articles');
});

Route::middleware('auth')->group(function () {
    Route::get('articles', 'ArticleController@index')->name('articles.index');
    Route::get('articles/create', 'ArticleController@create')->name('articles.create');
    Route::post('articles', 'ArticleController@store')->name('articles.store');
    Route::get('articles/{article}', 'ArticleController@show')->name('articles.show');
    Route::get('articles/edit/{article}', 'ArticleController@edit')->name('articles.edit');
    Route::patch('articles/{article}', 'ArticleController@update')->name('articles.update');
    Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

    Route::post('comments', 'CommentController@store')->name('comment.store');
});
