<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Task extends Model
{
    use Sortable;

    public $sortable = [
        'title',
        'period',
    ];

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
