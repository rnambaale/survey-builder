<?php

namespace Tests\Feature;

use App\Question;
use App\Survey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponsesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_user_can_view_response_form()
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
}
