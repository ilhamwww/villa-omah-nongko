<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Resolve a stored image path or absolute URL into a public URL.
     *
     * - If $path is null/empty, returns $fallback (also resolved through this method).
     * - If $path is already a full URL (http/https) or a data URI, returns it as is.
     * - Otherwise treats $path as a relative path inside the public storage disk
     *   and prefixes it with asset('storage/...').
     */
    public static function url(?string $path, ?string $fallback = null): string
    {
        if (! $path) {
            return $fallback ? self::url($fallback) : '';
        }

        if (
            str_starts_with($path, 'http://')
            || str_starts_with($path, 'https://')
            || str_starts_with($path, 'data:')
            || str_starts_with($path, '//')
        ) {
            return $path;
        }

        // Allow callers to pass an already public-relative path like "/images/foo.jpg"
        if (str_starts_with($path, '/')) {
            return asset(ltrim($path, '/'));
        }

        return asset('storage/' . $path);
    }
}
