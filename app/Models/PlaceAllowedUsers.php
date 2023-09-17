<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceAllowedUsers extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_type',
        'place_id',
    ];

    protected $casts = [
        'user_type' => UserType::class
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
