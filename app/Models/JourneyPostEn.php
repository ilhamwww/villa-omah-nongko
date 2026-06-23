<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JourneyPostEn extends Model
{
    protected $table = 'journey_posts_en';

    protected $guarded = [];

    public function journeyPost()
    {
        return $this->belongsTo(JourneyPost::class);
    }
}