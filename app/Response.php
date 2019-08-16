<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function addAnswer($attributes)
    {
        return $this->answers()->create($attributes);
    }
}
