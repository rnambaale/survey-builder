<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;

class SurveyAPIController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();

        return $surveys;
    }
}
