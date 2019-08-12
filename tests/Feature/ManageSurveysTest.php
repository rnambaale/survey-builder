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

    /** @test */
    public function a_user_can_view_existing_surveys()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $this->get('/surveys')
            ->assertSee($survey->title);
    }

    /** @test */
    public function a_user_can_create_a_survey()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $this->get('/surveys/create')->assertStatus(200);

        $attributes = ['title' => $this->faker->title()];

        $this->post('/surveys', $attributes)->assertRedirect('/surveys');

        $this->assertDatabaseHas('surveys', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_survey()
    {
        $this->withoutExceptionHandling();

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
        $this->withoutExceptionHandling();

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
}
