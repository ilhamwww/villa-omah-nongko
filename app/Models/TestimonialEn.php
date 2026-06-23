<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialEn extends Model
{
    protected $table = 'testimonials_en';

    protected $guarded = [];

    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}