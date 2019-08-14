<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Survey;
use App\Question;

use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function store(Survey $survey)
    {
        $question = $survey->addQuestion([
            'question_text' => request('question_text'),
            'question_type' => 'input'
        ]);

        //return response()->json(['message' => 'Question created!', 'status' => 1, 'question_ID' => $question->id]);

        return response()->json($question, 201);
    }

    public function destroy(Survey $survey, Question $question)
    {
        $question->delete();

        return response()->json(['message' => 'Question deleted!', 'status' => 1, 'question_ID' => $question->id]);
    }
}
