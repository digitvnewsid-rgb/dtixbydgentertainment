<?php

namespace App\Enums;

enum UserRole: string
{
    case Administrator = 'administrator';
    case Creator = 'creator';
    case Customer = 'customer';
    case Ticketing = 'ticketing';

    public function label(): string
    {
        return match ($this) {
            self::Administrator => 'Administrator',
            self::Creator => 'Creator',
            self::Customer => 'Customer',
            self::Ticketing => 'Ticketing',
        };
    }

    public function dashboardRoute(): string
    {
        return match ($this) {
            self::Administrator => 'admin.dashboard',
            self::Creator => 'creator.dashboard',
            self::Customer => 'customer.dashboard',
            self::Ticketing => 'ticketing.dashboard',
        };
    }
}
