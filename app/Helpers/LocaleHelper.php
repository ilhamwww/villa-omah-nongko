<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class LocaleHelper
{
    public static function switchUrl(string $targetLocale): string
    {
        if (! in_array($targetLocale, ['id', 'en'], true)) {
            $targetLocale = 'id';
        }

        $route = Request::route();
        $routeName = $route?->getName();

        if (! $routeName) {
            return $targetLocale === 'id'
                ? route('home.default')
                : route('home.index', ['locale' => 'en']);
        }

        $query = Request::query();
        unset($query['locale']);

        if (in_array($routeName, ['home.default', 'home.index'], true)) {
            $url = $targetLocale === 'id'
                ? route('home.default')
                : route('home.index', ['locale' => 'en']);

            return $query ? $url.'?'.http_build_query($query) : $url;
        }

        $params = $route->parameters();

        if ($routeName === 'journey.show' && isset($params['slug'])) {
            $post = \App\Models\JourneyPost::whereSlug($params['slug'])
                ->with('translationEn')
                ->first();

            if ($post) {
                $indonesianSlug = $post->getRawOriginal('slug');
                $params['slug'] = $targetLocale === 'en'
                    ? ($post->translationEn?->slug ?: $indonesianSlug)
                    : $indonesianSlug;
            }
        }

        $params['locale'] = $targetLocale;
        $url = route($routeName, $params);

        return $query ? $url.'?'.http_build_query($query) : $url;
    }
}