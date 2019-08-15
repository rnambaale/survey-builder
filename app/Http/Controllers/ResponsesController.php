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

    public function store(Survey $survey)
    {
        $answers = request('answers');
        $answers = array_values(array_filter($answers));

        $response = $survey->addResponse();

        if (request('answers')) {
            foreach ($answers as $answer) {
                $response->addAnswer([
                    'answer_value'  => $answer['answer_value'],
                    'question_id'   => $answer['question_id']
                ]);
            }
        }

        return redirect('response/success');
    }

    public function success()
    {
        # code...
    }
}
