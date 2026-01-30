<?php

namespace App\Enums;

enum LevelEnum: string
{
    case L0 = '0.5';
    case L1 = '1';
    case L2 = '2';
    case L3 = '3';
    case L4 = '4';
    case L5 = '5';
    case L6 = '6';
    case L7 = '7';
    case L8 = '8';

    public static function options(): array
    {
        return(collect(self::cases()))
            ->map(fn ($case) => [
                'value' => $case->value,
                'label' => $case->value,
            ])
            ->values()
            ->toArray();
    }
}
