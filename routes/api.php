<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('surveys', 'API\SurveyController@index');

/** Questions */
Route::post('surveys/{survey}/questions', 'API\QuestionsController@store');
Route::delete('surveys/{survey}/questions/{question}', 'API\QuestionsController@destroy');


/** Choices */
Route::post('questions/{question}/choices', 'API\ChoicesController@store');
Route::delete('questions/{question}/choices/{choice}', 'API\ChoicesController@destroy');
