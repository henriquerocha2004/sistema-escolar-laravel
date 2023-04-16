<?php

namespace App\School\Secretary\Enums;

use App\School\Common\Traits\GetsAttributes;
use App\School\Secretary\Enums\Attributes\Description;

enum ShiftEnum: string
{
    use GetsAttributes;

    #[Description('Todos')]
    case ALL = 'all';
    #[Description('Matutino')]
    case MORNING = 'morning';
    #[Description('Vespertino')]
    case AFTERNOON = 'afternoon';
    #[Description('Noturno')]
    case EVENING = 'evening';
    #[Description('Tempo Integral')]
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

    public static function getFriendlyProperties(): array
    {
       $data = array_map(fn ($enum) => [
            'name' => self::getDescription($enum),
            'value' => $enum->value,
       ], self::cases());

       return $data;
    }

    public function getFriendlyProperty(): string
    {
        return $this->getDescription($this);
    }
}
