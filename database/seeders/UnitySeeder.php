<?php

namespace Database\Seeders;

use App\Models\Unity;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class UnitySeeder extends Seeder
{
    public function run(): void
    {
        $unities = ['Jardim Carvalho', 'Jardim Ibirapuera', 'Comunidade Terapêutica'];
        Arr::map($unities, fn($unity) => Unity::create(['name' => $unity]));
    }
}
