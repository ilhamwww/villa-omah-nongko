<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureEn extends Model
{
    protected $table = 'features_en';

    protected $guarded = [];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}