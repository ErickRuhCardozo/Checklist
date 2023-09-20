<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Checklist extends Model
{
    use Sortable;

    public $sortable = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'is_done',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_done' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scans()
    {
        return $this->hasMany(Scan::class);
    }

    public function checkedPlaces()
    {
        $scans = $this->scans()->get();
        return $scans->map(fn($scan) => $scan->place);
    }

    public function wasUpdated()
    {
        return !$this->created_at->eq($this->updated_at);
    }
}
