<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING   = 'pending';   // В обработке
    case PREPARING = 'preparing'; // Собирается
    case READY     = 'ready';     // Готов к выдаче
    case CANCELLED = 'cancelled'; // Отменен

    public static function toArray(): array
    {
        $cases = [];

        foreach (self::cases() as $case) {
            $cases[$case->name] = $case->value;
        }

        return $cases;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
