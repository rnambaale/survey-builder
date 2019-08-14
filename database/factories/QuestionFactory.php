<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\Survey;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'question_text' => $faker->sentence(),
        'question_type' => 'input',
        'question_order' => 1,
        'survey_id' => function () {
            return factory(Survey::class)->create()->id;
        }
    ];
});
