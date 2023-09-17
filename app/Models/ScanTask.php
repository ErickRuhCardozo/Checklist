<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScanTask extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'scan_id',
        'task_id',
    ];

    public function scan()
    {
        return $this->belongsTo(Scan::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
