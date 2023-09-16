<?php

namespace Database\Seeders;

use App\Models\Unity;
use App\Models\User;
use App\Models\UserType;
use App\Models\WorkPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $carvalho = Unity::where('name', 'Jardim Carvalho')->first();
        $ibirapuera = Unity::where('name', 'Jardim Ibirapuera')->first();
        $comunidade = Unity::where('name', 'Comunidade Terapêutica')->first();
        $users = [
            [
                'name' => 'Marcel De Geus',
                'password' => 'DeGeus13',
                'type' => UserType::ADMIN,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Carlos Alexandre',
                'password' => 'carlinhos',
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Jonathan Marques',
                'password' => 'marques',
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Jonathan Pinheiro',
                'password' => 'pinheiro',
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::NOCTURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Josenei Trappel',
                'password' => 'trappel',
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::NOCTURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Aurenito Antônio',
                'password' => 'aurenito',
                'type' => UserType::CHEF,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Lucas Silva',
                'password' => 'lucas',
                'type' => UserType::CHEF,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Alisson Moura',
                'password' => 'purungo',
                'type' => UserType::BAKER,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
        ];

        Arr::map($users, fn($user) => User::create($user));
    }
}
