<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageEn extends Model
{
    protected $table = 'pages_en';

    protected $guarded = [];

    protected $casts = [
        'content_blocks' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}