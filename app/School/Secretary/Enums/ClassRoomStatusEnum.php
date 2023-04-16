<?php

namespace App\School\Secretary\Enums;

use App\School\Common\Traits\GetsAttributes;
use App\School\Secretary\Enums\Attributes\Description;

enum ClassRoomStatusEnum: string
{
    use GetsAttributes;

    #[Description('Todos')]
    case ALL = 'all';
    #[Description('Aberto')]
    case OPEN = 'open';
    #[Description('Fechado')]
    case CLOSED = 'closed';

    public static function all(): array
    {
        return [
            self::OPEN->name,
            self::CLOSED->value,
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

    public function toTemplateHtml(): string
    {
        $color = $this->value == self::OPEN->value ? 'bg-green-500' : 'bg-red-500';
        $name = $this->getFriendlyProperty();

        return "
            <span
                class='$color text-white text-xs font-medium mr-2 px-3 py-1 rounded-full dark:bg-green-900 dark:text-green-300'>
                $name
            </span>
        ";
    }
}
