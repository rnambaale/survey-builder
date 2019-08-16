<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(Question::class)
            ->orderBy('question_order', "asc");
    }

    public function addQuestion($attributes)
    {
        //$last_question = Question::orderBy('id', 'desc')->first();
        $last_question = Question::where('survey_id', $this->id)->orderBy('question_order', 'desc')->first();

        if ($last_question) {
            $question_order = ($last_question->question_order + 1);
        } else {
            $question_order =  1;
        }
        $attributes['question_order'] = $question_order;

        return $this->questions()->create($attributes);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function addResponse()
    {
        return $this->responses()->create();
    }
}
