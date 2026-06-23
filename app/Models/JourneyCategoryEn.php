<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JourneyCategoryEn extends Model
{
    protected $table = 'journey_categories_en';

    protected $guarded = [];

    public function journeyCategory()
    {
        return $this->belongsTo(JourneyCategory::class);
    }
}