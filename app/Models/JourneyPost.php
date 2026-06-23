<?php

namespace App\Models;

use App\Models\Traits\HasEnglishTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class JourneyPost extends Model
{
    use HasEnglishTranslation;

    protected $guarded = [];

    protected $translatableAttributes = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image_alt',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'faq_items',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'robots_index' => 'boolean',
        'robots_follow' => 'boolean',
        'is_featured' => 'boolean',
        'is_popular' => 'boolean',
        'faq_items' => 'array',
        'related_post_ids' => 'array',
        'schema_override' => 'array',
        'views_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(JourneyCategory::class, 'journey_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc('views_count');
    }

    public function getReadingTimeAttribute($value)
    {
        if ($value) return $value;
        $wordCount = str_word_count(strip_tags($this->content ?? ''));
        return max(1, (int) ceil($wordCount / 200));
    }

    public function getUrlAttribute(): string
    {
        return route('journey.show', $this->slug);
    }

    public function relatedPosts()
    {
        if (empty($this->related_post_ids)) {
            return static::published()
                ->where('journey_category_id', $this->journey_category_id)
                ->where('id', '!=', $this->id)
                ->limit(3)
                ->get();
        }
        return static::whereIn('id', $this->related_post_ids)->published()->get();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}