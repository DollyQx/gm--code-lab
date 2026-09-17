<?php

namespace App\Enums;

enum DocumentVisibility: string
{
    case PRIVATE = 'private';
    case CLIENT = 'client';
    case PUBLIC = 'public';

    public function label(): string
    {
        return match ($this) {
            self::PRIVATE => 'Internal / Private',
            self::CLIENT => 'Client Accessible',
            self::PUBLIC => 'Publicly Accessible',
        };
    }
}
