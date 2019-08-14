<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Choice;
use App\Question;
use Faker\Generator as Faker;

$factory->define(Choice::class, function (Faker $faker) {
    return [
        'choice_text'   => $faker->sentence(),
        'choice_order'  => 1,
        'question_id'   => function () {
            return factory(Question::class)->create()->id;
        }
    ];
});
