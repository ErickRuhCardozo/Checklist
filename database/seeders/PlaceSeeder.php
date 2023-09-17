<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\PlaceAllowedUsers;
use App\Models\Unity;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $carvalho = Unity::where('name', 'Jardim Carvalho')->first();
        $places = [
            ['name' => 'Banheiro 1', 'qrcode' => 'bQUqU72UDq', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Lavanderia', 'qrcode' => 'WVPEyMK0m2', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Rouparia', 'qrcode' => 'J03sruUnKx', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiro 2', 'qrcode' => 'LGhbYJNDed', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Quarto 3', 'qrcode' => 't3RXTaKyBo', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Quarto 2', 'qrcode' => 'RBiPhuwPlI', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Quarto 1', 'qrcode' => 'HvBBXZQ3Nd', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiro 3', 'qrcode' => 'ZtnA5EjjdN', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Quarto 4', 'qrcode' => 'Na4GgcY0KS', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiro 4', 'qrcode' => '1amSbB2ZEo', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Quarto 5', 'qrcode' => 'iAU5z4xOv3', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Sala Multimídia', 'qrcode' => 'LjlTY2t9xo', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Inserção Digital', 'qrcode' => 'DO7WojaLXj', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Sala de Notas', 'qrcode' => 'hlabdiLTKj', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Sala de TV', 'qrcode' => 'xjUjRLWfcu', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiro Funcionários Cozinha', 'qrcode' => 'M37IGdiV0q', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Refeitório', 'qrcode' => 'gYBhe1VHsm', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Salão de Eventos', 'qrcode' => 'lt6TWyEbev', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiro PCD', 'qrcode' => 'KOlrfIZnp1', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiro Masculino Igreja', 'qrcode' => 'V4jrUqpXZz', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiro Feminino Igreja', 'qrcode' => 'RAMQJlh3vf', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Recepção', 'qrcode' => 'VFafzaWnoK', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Banheiros Projeto', 'qrcode' => 'dxppBpgqGB', 'allowedUsers' => [UserType::CAREGIVER]],
            ['name' => 'Lixos e Compostagem', 'qrcode' => 'vJYok2knz3', 'allowedUsers' => [UserType::CAREGIVER]],
        ];

        foreach ($places as $place) {
            $model = Place::create([
                'name' => $place['name'],
                'qrcode' => $place['qrcode'],
                'unity_id' => $carvalho->id
            ]);

            foreach ($place['allowedUsers'] as $allowedUser) {
                PlaceAllowedUsers::create([
                    'place_id' => $model->id,
                    'user_type' => $allowedUser->value
                ]);
            }
        }
    }
}
