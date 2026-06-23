<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_redirects_root_to_default_locale(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/id');
    }

    public function test_the_application_returns_a_successful_response_for_default_locale(): void
    {
        $response = $this->get('/id');

        $response->assertStatus(200);
    }
}
