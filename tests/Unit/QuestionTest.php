<?php

namespace Tests\Unit;

use App\Survey;
use App\Question;
use App\Choice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_belongs_to_a_survey()
    {
        $this->withoutExceptionHandling();

        $question = factory(Question::class)->create();

        $this->assertInstanceOf(Survey::class, $question->survey);
    }

    /** @test */
    public function it_can_add_a_choice()
    {
        $this->withoutExceptionHandling();

        $question = factory(Question::class)->create();

        $choice = $question->addChoice([
            'choice_text' => 'Sample Choice One'
        ]);

        $this->assertCount(1, $question->choices);
        $this->assertTrue($question->choices->contains($choice));
    }
}
