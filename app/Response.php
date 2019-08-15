<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
