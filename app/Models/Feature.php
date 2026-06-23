<?php

namespace App\Models;

use App\Models\Traits\HasEnglishTranslation;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasEnglishTranslation;

    protected $guarded = [];

    protected $translatableAttributes = [
        'title',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForPage($query, string $pageKey)
    {
        return $query->where('page_key', $pageKey);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}