<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Survey;
use App\Question;

class SurveyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_a_question()
    {
        $this->withoutExceptionHandling();

        $survey = factory(Survey::class)->create();

        $question = $survey->addQuestion([
            'question_text' => 'Test Question',
            'question_type' => 'input'
        ]);

        $this->assertCount(1, $survey->questions);
        $this->assertTrue($survey->questions->contains($question));
    }
}
