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
}
