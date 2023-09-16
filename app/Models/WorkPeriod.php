<?php

namespace App\Models;

enum WorkPeriod: int
{
    case DIURNAL = 1;
    case NOCTURNAL = 2;

    function label(): string
    {
        return match ($this) {
            self::DIURNAL => 'Diúrno',
            self::NOCTURNAL => 'Noturno',
        };
    }

    static function options(): array
    {
        return [
            ['value' => self::DIURNAL->value, 'label' => 'Diúrno'],
            ['value' => self::NOCTURNAL->value, 'label' => 'Noturno'],
        ];
    }
}

