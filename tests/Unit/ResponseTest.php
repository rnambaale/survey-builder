<?php

namespace Tests\Unit;

use App\Question;
use App\Response;
use App\Survey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_survey()
    {
        $this->withExceptionHandling();
        $response = factory(Response::class)->create();

        $this->assertInstanceOf(Survey::class, $response->survey);
    }

    /** @test */
    public function it_can_add_an_answer()
    {
        $this->withExceptionHandling();
        $response = factory(Response::class)->create();
        $question = factory(Question::class)->create();

        $answer = $response->addAnswer([
            'answer_value' => 'Sample Answer',
            'question_id' => $question->id
        ]);

        $this->assertCount(1, $response->answers);
        $this->assertTrue($response->answers->contains($answer));
    }
}
