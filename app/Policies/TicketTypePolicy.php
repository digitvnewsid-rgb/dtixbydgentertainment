<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Event;
use App\Models\TicketType;
use App\Models\User;

class TicketTypePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRole::Administrator, UserRole::Creator], true);
    }

    public function create(User $user, Event $event): bool
    {
        return app(EventPolicy::class)->update($user, $event);
    }

    public function update(User $user, TicketType $ticketType): bool
    {
        return app(EventPolicy::class)->update($user, $ticketType->event);
    }

    public function delete(User $user, TicketType $ticketType): bool
    {
        if (! app(EventPolicy::class)->update($user, $ticketType->event)) {
            return false;
        }

        return $ticketType->sold === 0;
    }
}
