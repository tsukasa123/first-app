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
    return view('welcome');
});

// Login
Route::group(['middleware' => 'auth'], function(){

    // User
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update', 'delete']]);

    // Follow/Unfollow
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    // Questions
    Route::resource('questions', 'QuestionsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);

    // Search
    Route::get('/results', 'QuestionsController@search')->name('search.results');

    // Trend
    Route::get('/trend', 'QuestionsController@trend')->name('questions.trend');

    // Answer
    Route::resource('answers', 'AnswersController', ['only' => ['store', 'edit', 'update', 'destroy']]);

    // Favorites
    Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
