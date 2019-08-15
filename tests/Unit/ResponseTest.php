<?php

namespace Tests\Unit;

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
}
