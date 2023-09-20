<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Place extends Model
{
    use Sortable;

    public $sortable = [
        'name'
    ];

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
