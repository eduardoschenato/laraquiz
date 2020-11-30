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

Route::get('/', 'HomeController@index')->name('home');
Route::post('quiz', 'HomeController@quiz')->name('quiz');
Route::post('resultado', 'HomeController@result')->name('result');

Route::get('logout', 'HomeController@logout')->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::prefix('categorias')->group(function() {
        Route::get('', 'CategoryController@index')->name('categories.index');
        Route::get('novo', 'CategoryController@create')->name('categories.create');
        Route::post('', 'CategoryController@store')->name('categories.store');
        Route::get('{id}', 'CategoryController@edit')->name('categories.edit');
        Route::put('{id}', 'CategoryController@update')->name('categories.update');
        Route::delete('{id}', 'CategoryController@destroy')->name('categories.destroy');
    });
    
    Route::prefix('questoes')->group(function() {
        Route::get('', 'QuestionController@index')->name('questions.index');
        Route::get('novo', 'QuestionController@create')->name('questions.create');
        Route::post('', 'QuestionController@store')->name('questions.store');
        Route::get('{id}', 'QuestionController@edit')->name('questions.edit');
        Route::put('{id}', 'QuestionController@update')->name('questions.update');
        Route::delete('{id}', 'QuestionController@destroy')->name('questions.destroy');
    
        Route::prefix('{question_id}/opcoes')->group(function() {
            Route::get('', 'OptionController@index')->name('options.index');
            Route::get('novo', 'OptionController@create')->name('options.create');
            Route::post('', 'OptionController@store')->name('options.store');
            Route::get('{id}', 'OptionController@edit')->name('options.edit');
            Route::put('{id}', 'OptionController@update')->name('options.update');
            Route::delete('{id}', 'OptionController@destroy')->name('options.destroy');
        });
    });
    
    Route::prefix('usuarios')->group(function() {
        Route::get('', 'UserController@index')->name('users.index');
        Route::get('novo', 'UserController@create')->name('users.create');
        Route::post('', 'UserController@store')->name('users.store');
        Route::get('{id}', 'UserController@edit')->name('users.edit');
        Route::put('{id}', 'UserController@update')->name('users.update');
        Route::delete('{id}', 'UserController@destroy')->name('users.destroy');
    });
});

Auth::routes();
