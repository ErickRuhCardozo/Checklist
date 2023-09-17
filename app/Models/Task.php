<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'period',
        'place_id',
    ];

    protected $casts = [
        'period' => WorkPeriod::class
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
