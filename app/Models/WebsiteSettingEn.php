<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSettingEn extends Model
{
    protected $table = 'website_settings_en';

    protected $guarded = [];

    public function websiteSetting()
    {
        return $this->belongsTo(WebsiteSetting::class);
    }
}