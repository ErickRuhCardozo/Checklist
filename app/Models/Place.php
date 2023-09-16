<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'qrcode',
        'unity_id',
    ];

    public function unity()
    {
        return $this->belongsTo(Unity::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
