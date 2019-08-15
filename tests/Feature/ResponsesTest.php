<?php

namespace Tests\Feature;

use App\Answer;
use App\Question;
use App\Survey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponsesTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * @test
     */
    public function a_guest_can_view_response_form()
    {
        $this->withExceptionHandling();

        $survey = factory(Survey::class)->create();
        $question = factory(Question::class)->create(['survey_id' => $survey->id]);
        $question2 = factory(Question::class)->create(['survey_id' => $survey->id]);

        $this->get('/respond/' . $survey->id)
            ->assertStatus(200)
            ->assertSee($survey->title)
            ->assertSee($question->question_text)
            ->assertSee($question2->question_text);
    }

    /** @test */
    public function a_guest_can_submit_response_form()
    {
        $this->withExceptionHandling();

        $question = factory(Question::class)->create();

        $answer1 = [
            'question_id'      => $question->id,
            'answer_value'  => $this->faker->sentence
        ];

        $answer2 = [
            'question_id'      => $question->id,
            'answer_value'  => $this->faker->sentence
        ];

        $answers = factory(Answer::class, 2)->raw(['question_id' => $question->id]);

        $this->post('/response/' . $question->survey_id, [
            'answers' => [
                $answer1, $answer2
            ]
        ])->assertRedirect('/response/success');

        $this->assertDatabaseHas('responses', ['survey_id' => $question->survey_id]);
        $this->assertDatabaseHas('answers', $answer1);
        $this->assertDatabaseHas('answers', $answer2);
    }
}
