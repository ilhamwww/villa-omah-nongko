<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class LocaleHelper
{
    public static function switchUrl(string $targetLocale): string
    {
        $route = Request::route();
        $routeName = $route ? $route->getName() : null;
        if (!$routeName) {
            return url($targetLocale);
        }
        
        $params = $route->parameters();
        
        if (isset($params['slug'])) {
            $slug = $params['slug'];
            if ($routeName === 'journey.show') {
                $post = \App\Models\JourneyPost::whereSlug($slug)->first();
                if ($post) {
                    if ($targetLocale === 'en') {
                        $translation = $post->translationEn;
                        $params['slug'] = ($translation && $translation->slug) ? $translation->slug : $post->slug;
                    } else {
                        $params['slug'] = $post->slug;
                    }
                }
            }
        }
        
        $params['locale'] = $targetLocale;
        $queryString = Request::getQueryString();
        
        return route($routeName, $params) . ($queryString ? '?' . $queryString : '');
    }
}