<?php

namespace App\Http\Controllers\API;

use App\Choice;
use App\Question;
use App\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChoicesController extends Controller
{
    public function store(Question $question)
    {
        $choice = $question->addChoice([
            'choice_text'   => request('choice_text')
        ]);

        return response()->json($choice, 201);
    }

    public function destroy(Question $question, Choice $choice)
    {
        $choice->delete();

        return response()->json([
            'message' => 'Question deleted!',
            'status' => 1,
            'choice_ID' => $choice->id,
            'question_ID' => $question->id
        ]);
    }
}
