<?php

namespace App\Enums;

enum TicketTypeStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case SoldOut = 'sold_out';
}
