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

Route::get('surveys', 'SurveyAPIController@index');
Route::post('surveys/{survey}/questions', 'SurveyAPIController@questions');

Route::delete('surveys/{survey}/questions/{question}', 'SurveyAPIController@destroy_question');
