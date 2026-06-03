<?php

namespace App\Enums;

enum TicketStatus: string
{
    case Active = 'active';
    case Used = 'used';
    case Expired = 'expired';
    case Cancelled = 'cancelled';
    case Refunded = 'refunded';
}
