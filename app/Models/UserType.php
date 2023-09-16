<?php

namespace App\Models;

enum UserType: int
{
    case ADMIN = 1;
    case CAREGIVER = 2;
    case CHEF = 3;
    case BAKER = 4;

    function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::CAREGIVER => 'Cuidador',
            self::CHEF => 'Cozinheiro',
            self::BAKER => 'Padeiro'
        };
    }

    static function options(): array
    {
        return [
            ['value' => self::ADMIN->value, 'label' => 'Administrador'],
            ['value' => self::CAREGIVER->value, 'label' => 'Cuidador'],
            ['value' => self::CHEF->value, 'label' => 'Cozinheiro'],
            ['value' => self::BAKER->value, 'label' => 'Padeiro']
        ];
    }
}

