<?php

namespace Tests\Feature;

use App\Choice;
use App\Question;
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

        $this->get('surveys/' . $survey->id . '/questions')
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
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $question1 = factory(Question::class)->create(['survey_id' => $survey->id]);

        $question1Update = ['ID' => $question1->id, 'question_text' => 'Updated Text', 'question_type' => 'input'];

        $question2 = factory(Question::class)->create(['survey_id' => $survey->id]);

        $question2Update = ['ID' => $question2->id, 'question_text' => 'Updated Text', 'question_type' => 'input'];

        $question_attributes = [
            $question1Update,
            $question2Update
        ];

        $this->patch('surveys/' . $survey->id . '/questions', [
            'questions' => $question_attributes,
            'choices'   => []
        ])->assertRedirect('surveys/' . $survey->id . '/questions');

        $this->assertDatabaseHas('questions', $question1Update);
        $this->assertDatabaseHas('questions', $question2Update);
    }

    /** @test */
    public function a_user_can_batch_update_question_choices()
    {
        $this->withExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $survey = factory(Survey::class)->create();

        $question = factory(Question::class)->create(['survey_id' => $survey->id]);

        $choice1 = factory(Choice::class)->create(['question_id' => $question->id]);
        $choice2 = factory(Choice::class)->create(['question_id' => $question->id]);

        $choice1_update = [
            'ID'            => $choice1->id,
            'choice_text'   => 'Updated Text'
        ];

        $choice2_update = [
            'ID'            => $choice2->id,
            'choice_text'   => 'Updated Text'
        ];

        $question_update = [
            'ID'            => $question->id,
            'question_text' => 'Updated Text',
            'question_type' => 'input'
        ];

        $question_attributes = [
            $question_update
        ];

        $choices_attributes = [
            $choice1_update,
            $choice2_update
        ];

        $this->patch('surveys/' . $survey->id . '/questions', [
            'questions' => $question_attributes,
            'choices'   => $choices_attributes
        ])->assertRedirect('surveys/' . $survey->id . '/questions');

        $this->assertDatabaseHas('choices', $choice1_update);
        $this->assertDatabaseHas('choices', $choice2_update);
        $this->assertDatabaseHas('questions', $question_update);
    }

    /** @test */
    public function a_user_can_add_a_choice_to_a_question()
    {
        $question = factory(Question::class)->create();

        $choice_attributes = [
            'choice_text' => $this->faker->sentence()
        ];

        $this->post('/api/questions/' . $question->id . '/choices', $choice_attributes)
            ->assertStatus(201);

        $this->assertDatabaseHas('choices', $choice_attributes);
    }

    /** @test */
    public function a_user_can_delete_a_choice_of_a_question()
    {
        $choice = factory(Choice::class)->create();

        $this->delete('/api/questions/' . $choice->question_id . '/choices/' . $choice->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('choices', $choice->toArray());
    }
}
