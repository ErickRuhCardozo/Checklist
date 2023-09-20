<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Unity extends Model
{
    use Sortable;

    public $timestamps = false;

    public $sortable = [
        'name'
    ];

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

    public function placesSortable($query, string $direction)
    {
        return $query->selectRaw('unities.*, COUNT(unities.id) as place_count')
                     ->leftJoin('places', 'places.unity_id', '=', 'unities.id')
                     ->groupBy('unities.id')
                     ->orderBy('place_count', $direction === 'asc' ? 'desc' : 'asc');
    }

    public function usersSortable($query, string $direction)
    {
        return $query->selectRaw('unities.*, COUNT(users.unity_id) as user_count')
                     ->leftJoin('users', 'users.unity_id', '=', 'unities.id')
                     ->groupBy('unities.id')
                     ->orderBy('user_count', $direction === 'asc' ? 'desc' : 'asc');
    }
}
