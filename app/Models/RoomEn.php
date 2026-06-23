<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomEn extends Model
{
    protected $table = 'rooms_en';

    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}