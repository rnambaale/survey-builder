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



Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/surveys', 'SurveysController@index');
    Route::get('/surveys/create', 'SurveysController@create');
    Route::post('/surveys', 'SurveysController@store');

    Route::get('/surveys/{survey}/edit', 'SurveysController@edit');
    Route::patch('/surveys/{survey}', 'SurveysController@update');

    Route::get('/surveys/{survey}/questions', 'QuestionsController@index');
    Route::patch('/surveys/{survey}/questions', 'QuestionsController@updates');


    Route::get('/surveys/{survey}/results', 'ResultsController@index');
});

Route::get('/respond/{survey}', 'ResponsesController@create');
