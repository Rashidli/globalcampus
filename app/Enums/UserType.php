<?php

namespace App\Enums;


enum UserType : string
{
    case AGENT = 'AGENT';
    case STUDENT = 'STUDENT';
    case USER = 'USER';

    public function label(): string
    {
        return match ($this) {
            self::AGENT => 'Agent',
            self::STUDENT => 'Tələbə',
            self::USER => 'User'
        };
    }
}
