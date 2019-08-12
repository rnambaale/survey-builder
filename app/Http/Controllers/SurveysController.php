<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;

class SurveysController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();

        return view('surveys.index', compact('surveys'));
    }
}
