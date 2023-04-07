<?php

namespace App\School\Secretary\Enums;

enum ShiftEnum: string
{
    case MORNING = 'morning';
    case AFTERNOON = 'afternoon';
    case EVENING = 'evening';
    case FULL_TIME = 'full_time';

    public static function all(): array
    {
        return [
            self::EVENING->value,
            self::FULL_TIME->value,
            self::AFTERNOON->value,
            self::MORNING->value,
        ];
    }
}
