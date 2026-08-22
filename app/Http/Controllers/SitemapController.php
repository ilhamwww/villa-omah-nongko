<?php

namespace App\Http\Controllers;

use App\Models\JourneyPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        foreach (['id', 'en'] as $locale) {
            $urls[] = [
                'loc' => route('home.index', ['locale' => $locale]),
                'priority' => '1.0',
                'freq' => 'weekly',
            ];
            $urls[] = [
                'loc' => route('the-villa', ['locale' => $locale]),
                'priority' => '0.9',
                'freq' => 'monthly',
            ];
            $urls[] = [
                'loc' => route('gallery', ['locale' => $locale]),
                'priority' => '0.8',
                'freq' => 'monthly',
            ];
            $urls[] = [
                'loc' => route('journey.index', ['locale' => $locale]),
                'priority' => '0.8',
                'freq' => 'weekly',
            ];
        }

        $posts = JourneyPost::query()
            ->published()
            ->with('translationEn')
            ->get();

        foreach ($posts as $post) {
            $indonesianSlug = $post->getRawOriginal('slug');

            if ($indonesianSlug) {
                $urls[] = [
                    'loc' => route('journey.show', [
                        'locale' => 'id',
                        'slug' => $indonesianSlug,
                    ]),
                    'priority' => '0.7',
                    'freq' => 'monthly',
                    'lastmod' => ($post->updated_at ?? $post->published_at)->toDateString(),
                ];
            }

            $englishSlug = $post->translationEn?->slug ?: $indonesianSlug;

            if ($englishSlug) {
                $urls[] = [
                    'loc' => route('journey.show', [
                        'locale' => 'en',
                        'slug' => $englishSlug,
                    ]),
                    'priority' => '0.7',
                    'freq' => 'monthly',
                    'lastmod' => ($post->updated_at ?? $post->published_at)->toDateString(),
                ];
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8')."</loc>\n";
            $xml .= '    <lastmod>'.($url['lastmod'] ?? now()->toDateString())."</lastmod>\n";
            $xml .= "    <changefreq>{$url['freq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(): Response
    {
        $isProduction = app()->environment('production');

        if ($isProduction) {
            $content = "User-agent: *\nAllow: /\n\nSitemap: " . route('sitemap') . "\n";
        } else {
            $content = "User-agent: *\nDisallow: /\n";
        }

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}