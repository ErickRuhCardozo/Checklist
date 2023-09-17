<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    protected $fillable = [
        'checklist_id',
        'place_id',
        'worker',
        'observations'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $touches = [
        'checklist'
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function tasksDone()
    {
        return ScanTask::where('scan_id', $this->id)->get();
    }
}
