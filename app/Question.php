<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function addChoice($attributes)
    {
        //$last_choice = Choice::orderBy('id', 'desc')->first();
        //$last_choice = $this->choices->last();
        //$last_choice = $this->choices->sortByDesc('id')->first();
        $last_choice = Choice::where('question_id', $this->id)->orderBy('id', 'desc')->first();

        if ($last_choice) {
            $choice_order = ($last_choice->choice_order + 1);
        } else {
            $choice_order =  1;
        }

        $attributes['choice_order'] = $choice_order;

        return $this->choices()->create($attributes);
    }
}
