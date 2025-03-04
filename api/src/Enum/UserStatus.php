<?php

namespace App\Enum;

enum UserStatus: string
{
    case INVITED = 'invited';
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';
}
