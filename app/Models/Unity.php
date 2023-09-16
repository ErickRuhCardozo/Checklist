<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    static function options()
    {
        return self::all()->map(fn($unity) => ['value' => $unity->id, 'label' => $unity->name])->toArray();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
