<?php

namespace App\Enum;

enum UserRoleEnum :string
{
    // Distintos roles del usuario
    case MANAGER = 'manager';
    case REVISOR = 'revisor';
    case COMPRADOR = 'comprador';
    
    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
    public static function options(): array
    {
        return [
            self::MANAGER->value => 'Manager',
            self::REVISOR->value => 'Revisor',
            self::COMPRADOR->value => 'Comprador',
        ];
    }
}
