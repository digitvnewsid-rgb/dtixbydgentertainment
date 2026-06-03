<?php

namespace App\Services;

use App\Enums\EventStatus;
use App\Models\Event;

class EventStatusService
{
    public function publish(Event $event): void
    {
        $event->update(['status' => EventStatus::Published]);
    }

    public function close(Event $event): void
    {
        $event->update(['status' => EventStatus::Closed]);
    }

    public function cancel(Event $event): void
    {
        $event->update(['status' => EventStatus::Cancelled]);
    }
}
