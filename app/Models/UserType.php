<?php

namespace App\Models;

enum UserType: int
{
    case ADMIN = 1;
    case COORDINATOR = 2;
    case CAREGIVER = 3;
    case CHEF = 4;
    case BAKER = 5;

    function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::COORDINATOR => 'Coordenador',
            self::CAREGIVER => 'Cuidador',
            self::CHEF => 'Cozinheiro',
            self::BAKER => 'Padeiro'
        };
    }

    static function options(): array
    {
        return [
            ['value' => self::ADMIN->value, 'label' => 'Administrador'],
            ['value' => self::COORDINATOR->value, 'label' => 'Coordenador'],
            ['value' => self::CAREGIVER->value, 'label' => 'Cuidador'],
            ['value' => self::CHEF->value, 'label' => 'Cozinheiro'],
            ['value' => self::BAKER->value, 'label' => 'Padeiro']
        ];
    }
}

