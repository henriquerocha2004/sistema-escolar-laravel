<?php

namespace App\School\Secretary\Enums;

enum ClassRoomStatusEnum: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';

    public static function all(): array
    {
        return [
            self::OPEN->name,
            self::CLOSED->value,
        ];
    }
}
