<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Question;

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

    public function update_questions(Survey $survey)
    {
        $questions = request('questions');
        $questions = array_values(array_filter($questions));

        foreach ($questions as $req_question) {
            $question = Question::findOrFail($req_question['ID']);
            $question->question_text = $req_question['question_text'];
            $question->question_type = $req_question['question_type'];
            $question->save();
        }

        return redirect('surveys/' . $survey->id . '/questions');
    }
}
