<?php

namespace App\Models;

use App\Models\Traits\HasEnglishTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JourneyCategory extends Model
{
    use HasEnglishTranslation;

    protected $guarded = [];

    protected $translatableAttributes = [
        'name',
        'slug',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(JourneyPost::class);
    }

    public function publishedPosts(): HasMany
    {
        return $this->hasMany(JourneyPost::class)->where('status', 'published')->orderByDesc('published_at');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}