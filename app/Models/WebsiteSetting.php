<?php

namespace App\Models;

use App\Models\Traits\HasEnglishTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WebsiteSetting extends Model
{
    use HasEnglishTranslation;

    protected $guarded = [];

    protected $translatableAttributes = [
        'site_name',
        'site_tagline',
        'site_description',
        'address',
        'meta_title_default',
        'meta_description_default',
        'meta_keywords_default',
        'footer_text',
        'copyright_text',
    ];

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