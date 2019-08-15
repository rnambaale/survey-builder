<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

class ResponsesController extends Controller
{
    public function create(Survey $survey)
    {
        return view('responses.create', compact('survey'));
    }
}
