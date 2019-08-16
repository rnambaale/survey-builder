<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Question;
use App\Response;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'response_id' => function () {
            return factory(Response::class)->create()->id;
        },
        'question_id' => function () {
            return factory(Question::class)->create()->id;
        },
        'answer_value' => $faker->sentence()
    ];
});
