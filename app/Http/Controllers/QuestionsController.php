<?php

namespace App\Http\Controllers;

use App\Choice;
use Illuminate\Http\Request;
use App\Survey;
use App\Question;

class QuestionsController extends Controller
{

    public function index(Survey $survey)
    {
        return view('surveys.questions', compact('survey'));
    }

    public function updates(Survey $survey)
    {

        $questions = request('questions');
        $questions = array_values(array_filter($questions));


        $choices = request('choices');
        $choices = array_values(array_filter($choices));


        foreach ($questions as $req_question) {
            $question = Question::findOrFail($req_question['ID']);
            $question->question_text = $req_question['question_text'];
            $question->question_type = $req_question['question_type'];
            $question->save();
        }


        foreach ($choices as $req_choice) {
            $choice = Choice::findOrFail($req_choice['ID']);
            $choice->choice_text = $req_choice['choice_text'];
            $choice->save();
        }

        return redirect('surveys/' . $survey->id . '/questions');
    }
}
