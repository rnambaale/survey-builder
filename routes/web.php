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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/surveys', 'SurveysController@index');
    Route::get('/surveys/create', 'SurveysController@create');
    Route::post('/surveys', 'SurveysController@store');

    Route::get('/surveys/{survey}/edit', 'SurveysController@edit');
    Route::patch('/surveys/{survey}', 'SurveysController@update');
});
