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

    public function test_home_language_switcher_uses_locale_paths_without_query_parameters(): void
    {
        $englishUrl = route('home.index', ['locale' => 'en']);
        $indonesianUrl = route('home.default');

        $this->get('/')
            ->assertOk()
            ->assertSee('href="'.$englishUrl.'"', false)
            ->assertDontSee('?locale=en', false);

        $this->get('/en')
            ->assertOk()
            ->assertSee('href="'.$indonesianUrl.'"', false)
            ->assertDontSee('?locale=id', false);
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
            ->assertSee('<loc>' . route('home.default') . '</loc>', false)
            ->assertSee('<loc>' . route('home.index', ['locale' => 'en']) . '</loc>', false)
            ->assertSee(route('journey.index', ['locale' => 'id']), false)
            ->assertSee(route('journey.index', ['locale' => 'en']), false);
    }

    public function test_home_rating_has_permitted_accessible_image_semantics(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('role="img"', false)
            ->assertSee('aria-label="5 dari 5 bintang"', false);
    }

    public function test_llms_file_has_a_markdown_heading_and_links(): void
    {
        $response = $this->get('/llms.txt');

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('# Villa Omah Nongko', false)
            ->assertSee('[Beranda Bahasa Indonesia](https://www.villaomahnongko.com/)', false)
            ->assertSee('[Sitemap XML](https://www.villaomahnongko.com/sitemap.xml)', false);
    }
}
