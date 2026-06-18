<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WebsiteSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'links' => 'array',
        'social_links' => 'array',
        'robots_index_default' => 'boolean',
    ];

    protected static function booted()
    {
        static::deleting(function ($setting) {
            foreach (['logo', 'hero_image', 'logo_light', 'logo_dark', 'favicon', 'default_og_image', 'default_hero_image', 'footer_background_image'] as $field) {
                if ($setting->$field) {
                    Storage::disk('public')->delete($setting->$field);
                }
            }
        });

        static::updating(function ($setting) {
            foreach (['logo', 'hero_image', 'logo_light', 'logo_dark', 'favicon', 'default_og_image', 'default_hero_image', 'footer_background_image'] as $field) {
                if ($setting->isDirty($field)) {
                    $original = $setting->getOriginal($field);
                    if ($original) {
                        Storage::disk('public')->delete($original);
                    }
                }
            }
        });
    }

    /**
     * Get singleton instance (first record or create)
     */
    public static function instance(): self
    {
        return static::first() ?? static::create([]);
    }
}