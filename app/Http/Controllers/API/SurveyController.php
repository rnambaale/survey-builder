<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Survey;
use App\Question;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();

        return $surveys;
    }
}
