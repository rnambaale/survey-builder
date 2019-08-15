<?php

namespace Tests\Unit;

use App\Answer;
use App\Question;
use App\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_question()
    {
        $this->withExceptionHandling();

        $answer = factory(Answer::class)->create();

        $this->assertInstanceOf(Question::class, $answer->question);
    }

    /** @test */
    public function it_has_a_response()
    {
        $this->withExceptionHandling();

        $answer = factory(Answer::class)->create();

        $this->assertInstanceOf(Response::class, $answer->response);
    }
}
