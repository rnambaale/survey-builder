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

    public function create()
    {
        return view('surveys.create');
    }


    public function store(Request $request)
    {
        //validate
        $attributes = $request->validate(
            [
                'title'         => 'required',
            ]
        );

        // persist
        Survey::create($attributes);

        //redirect
        return redirect('surveys');
    }

    public function edit(Survey $survey)
    {
        return view('surveys.edit', compact('survey'));
    }

    public function update(Survey $survey)
    {
        $attributes = request()->validate(
            [
                'title'         => 'required',
            ]
        );

        $survey->update($attributes);

        return redirect('surveys');
    }

    public function questions(Survey $survey)
    {
        return view('surveys.questions', compact('survey'));
    }
}
