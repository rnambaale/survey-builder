<?php

use App\Choice;
use App\Question;
use App\Survey;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $survey = factory(Survey::class)->create(['title' => 'This is a Sample Survey']);
        $question = factory(Question::class)->create(
            [
                'survey_id'     => $survey->id,
                'question_text' => 'What is your name',
                'question_type' => 'input',
                'is_required'   => TRUE
            ]
        );

        $question2 = factory(Question::class)->create(
            [
                'survey_id' => $survey->id,
                'question_text' => 'Are you human',
                'question_type' => 'radio',
                'is_required'   => TRUE
            ]
        );

        $choice1 = factory(Choice::class)->create(
            [
                'choice_text' => 'Yes',
                'question_id' => $question2->id
            ]
        );

        $choice2 = factory(Choice::class)->create(
            [
                'choice_text' => 'No',
                'question_id' => $question2->id
            ]
        );
    }
}
