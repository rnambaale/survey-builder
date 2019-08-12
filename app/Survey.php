<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function addQuestion($attributes)
    {
        return $this->questions()->create($attributes);
    }
}
