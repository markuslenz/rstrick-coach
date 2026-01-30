<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case USER  = 'user';

    public static function options(): array
    {
        return(collect(self::cases()))
            ->map(fn ($case) => [
                'value' => $case->value,
                'label' => ucfirst($case->value),
            ])
            ->values()
            ->toArray();
    }
}
