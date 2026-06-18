<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            ['loc' => route('home.index'), 'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => route('the-villa'), 'priority' => '0.9', 'freq' => 'monthly'],
            ['loc' => route('gallery'), 'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => route('journey.index'), 'priority' => '0.8', 'freq' => 'weekly'],
        ];

        foreach (config('villa_content.journey_posts') as $post) {
            $urls[] = [
                'loc' => route('journey.show', $post['slug']),
                'priority' => '0.7',
                'freq' => 'monthly',
                'lastmod' => $post['date'],
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . ($url['lastmod'] ?? now()->toDateString()) . "</lastmod>\n";
            $xml .= "    <changefreq>{$url['freq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
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