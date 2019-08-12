<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Survey;


class ManageSurveysTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }


    /** @test */
    public function a_user_can_view_existing_surveys()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $this->get('/surveys')
            ->assertSee($survey->title);
    }

    /** @test */
    public function a_user_can_create_a_survey()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $this->get('/surveys/create')->assertStatus(200);

        $attributes = ['title' => $this->faker->title()];

        $this->post('/surveys', $attributes)->assertRedirect('/surveys');

        $this->assertDatabaseHas('surveys', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_survey()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $this->get('/surveys/' . $survey->id . '/edit')
            ->assertStatus(200)
            ->assertSee($survey->title);

        $attributes = ['title' => 'Some Updated Title'];

        $this->patch('/surveys/' . $survey->id, $attributes)->assertRedirect('/surveys');

        $this->assertDatabaseHas('surveys', $attributes);
    }

    /** @test */
    public function a_user_can_view_survey_questions()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();
        $question = $survey->addQuestion([
            'question_text' => $this->faker->sentence(),
            'question_type' => 'input'
        ]);

        $this->get('/surveys/' . $survey->id . '/questions')
            ->assertStatus(200)
            ->assertSee($survey->title)
            ->assertSee($question->question_text);
    }

    /** @test */
    public function a_user_can_add_a_question_to_a_survey()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $attributes = [
            'question_text' => $this->faker->sentence(),
            'question_type' => 'input'
        ];

        $this->post('/api/surveys/' . $survey->id . '/questions', $attributes)
            ->assertStatus(201);

        $this->assertDatabaseHas('questions', $attributes);
    }

    /** @test */
    public function a_user_can_delete_a_survey_question()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $question = $survey->addQuestion([
            'question_text' => $this->faker->sentence(),
            'question_type' => 'input'
        ]);

        $this->delete('/api/surveys/' . $survey->id . '/questions/' . $question->id)->assertStatus(200);

        $this->assertDatabaseMissing('questions', $question->toArray());
    }

    /** @test */
    public function a_user_can_batch_update_questions()
    {
        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $question1 = $survey->addQuestion([
            'question_text' => $this->faker->sentence(),
            'question_type' => 'input'
        ]);

        $question1Update = ['ID' => $question1->id, 'question_text' => 'Updated Text', 'question_type' => 'input'];

        $question2 = $survey->addQuestion([
            'question_text' => $this->faker->sentence(),
            'question_type' => 'input'
        ]);

        $question2Update = ['ID' => $question2->id, 'question_text' => 'Updated Text', 'question_type' => 'input'];

        $this->patch('surveys/' . $survey->id . '/questions', [
            'questions' => [
                $question1Update,
                $question2Update
            ]
        ])->assertRedirect('surveys/' . $survey->id . '/questions');

        $this->assertDatabaseHas('questions', $question1Update);
        $this->assertDatabaseHas('questions', $question2Update);
    }
}
