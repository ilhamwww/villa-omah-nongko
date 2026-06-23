<?php

namespace App\Models;

use App\Models\Traits\HasEnglishTranslation;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasEnglishTranslation;

    protected $guarded = [];

    protected $translatableAttributes = [
        'title',
        'hero_title',
        'hero_description',
        'content_blocks',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'robots_index' => 'boolean',
        'robots_follow' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public static function findByKey(string $key): ?self
    {
        return static::where('page_key', $key)->first();
    }
}