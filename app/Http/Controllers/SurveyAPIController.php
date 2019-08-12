<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Question;

class SurveyAPIController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();

        return $surveys;
    }

    public function questions(Survey $survey)
    {
        $question = $survey->addQuestion([
            'question_text' => '',
            'question_type' => 'input'
        ]);


        return response()->json(['message' => 'Question created!', 'status' => 1, 'question_ID' => $question->id]);
    }

    public function destroy_question(Survey $survey, Question $question)
    {
        $question->delete();
        return response()->json(['message' => 'Question deleted', 'status' => 1, 'question_ID' => $question->id]);
    }
}
