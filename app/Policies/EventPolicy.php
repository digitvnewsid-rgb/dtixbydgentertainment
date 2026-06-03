<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRole::Administrator, UserRole::Creator], true);
    }

    public function view(User $user, Event $event): bool
    {
        return $this->isAdmin($user) || $this->ownsEvent($user, $event);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::Administrator, UserRole::Creator], true);
    }

    public function update(User $user, Event $event): bool
    {
        return $this->isAdmin($user) || $this->ownsEvent($user, $event);
    }

    public function delete(User $user, Event $event): bool
    {
        if (! $this->update($user, $event)) {
            return false;
        }

        return ! $event->orders()->exists();
    }

    public function manageStatus(User $user, Event $event): bool
    {
        return $this->update($user, $event);
    }

    private function isAdmin(User $user): bool
    {
        return $user->role === UserRole::Administrator;
    }

    private function ownsEvent(User $user, Event $event): bool
    {
        return $user->role === UserRole::Creator && $event->creator_id === $user->id;
    }
}
