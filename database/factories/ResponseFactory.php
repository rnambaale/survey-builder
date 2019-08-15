<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Response;
use App\Survey;
use Faker\Generator as Faker;

$factory->define(Response::class, function (Faker $faker) {
    return [
        'survey_id' => function () {
            return factory(Survey::class)->create()->id;
        }
    ];
});
