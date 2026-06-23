<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCategoryEn extends Model
{
    protected $table = 'gallery_categories_en';

    protected $guarded = [];

    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class);
    }
}