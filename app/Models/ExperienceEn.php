<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienceEn extends Model
{
    protected $table = 'experiences_en';

    protected $guarded = [];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}