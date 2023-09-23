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
                'password' => env('MARCEL_DE_GEUS_PASSWORD'),
                'type' => UserType::ADMIN,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Carlos Alexandre',
                'password' => env('CARLOS_ALEXANDRE_PASSWORD'),
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Jonathan Marques',
                'password' => env('JONATHAN_MARQUES_PASSWORD'),
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Jonathan Pinheiro',
                'password' => env('JONATHAN_PINHEIRO_PASSWORD'),
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::NOCTURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Josenei Trappel',
                'password' => env('JOSENEI_TRAPPEL_PASSWORD'),
                'type' => UserType::CAREGIVER,
                'work_period' => WorkPeriod::NOCTURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Aurenito Antônio',
                'password' => env('AURENITO_ANTONIO_PASSWORD'),
                'type' => UserType::CHEF,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Lucas Silva',
                'password' => env('LUCAS_SILVA_PASSWORD'),
                'type' => UserType::CHEF,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
            [
                'name' => 'Alisson Moura',
                'password' => env('ALISSON_MOURA_PASSWORD'),
                'type' => UserType::BAKER,
                'work_period' => WorkPeriod::DIURNAL,
                'unity_id' => $carvalho->id
            ],
        ];

        Arr::map($users, fn($user) => User::create($user));
    }
}
