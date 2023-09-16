<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'password',
        'type',
        'work_period',
        'unity_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'type' => UserType::class,
        'work_period' => WorkPeriod::class
    ];

    public function unity()
    {
        return $this->belongsTo(Unity::class);
    }

    public static function options()
    {
        return self::all()->map(fn($user) => ['value' => $user->id, 'label' => $user->name])->toArray();
    }
}
