<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_root_renders_the_indonesian_home_without_redirect(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertHeaderMissing('Location');

        $this->assertSame('id', app()->getLocale());
    }

    public function test_the_application_returns_a_successful_response_for_default_locale(): void
    {
        $response = $this->get('/id');

        $response->assertStatus(200);
    }

    public function test_404_redirects_to_root(): void
    {
        $response = $this->get('/invalid-page-does-not-exist');

        $response->assertRedirect('/');
    }

    public function test_404_with_locale_redirects_to_locale_home(): void
    {
        $response = $this->get('/en/invalid-page-does-not-exist');
        $response->assertRedirect(route('home.index', ['locale' => 'en']));

        $responseId = $this->get('/id/invalid-page-does-not-exist');
        $responseId->assertRedirect(route('home.index', ['locale' => 'id']));
    }

    public function test_journey_show_works(): void
    {
        $response = $this->get('/id/journey/keindahan-hidup-di-tengah-pedesaan-dan-sawah-sleman');
        $response->assertStatus(200);
    }

    public function test_sitemap_returns_xml_for_both_locales(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/sitemap.xml');

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false)
            ->assertSee('<loc>'.route('home.default').'</loc>', false)
            ->assertSee('<loc>'.route('home.index', ['locale' => 'en']).'</loc>', false)
            ->assertSee(route('journey.index', ['locale' => 'id']), false)
            ->assertSee(route('journey.index', ['locale' => 'en']), false);
    }
}
