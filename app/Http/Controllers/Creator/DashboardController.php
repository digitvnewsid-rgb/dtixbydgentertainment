<?php

namespace App\Http\Controllers\Creator;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $creatorId = auth()->id();

        $eventIds = Event::where('creator_id', $creatorId)->pluck('id');

        return view('creator.dashboard', [
            'stats' => [
                'events' => $eventIds->count(),
                'tickets_sold' => Ticket::whereIn('event_id', $eventIds)->count(),
                'revenue' => Order::whereIn('event_id', $eventIds)
                    ->where('payment_status', PaymentStatus::Paid)
                    ->sum('total_amount'),
                'attendees' => Ticket::whereIn('event_id', $eventIds)->count(),
                'check_ins' => Ticket::whereIn('event_id', $eventIds)->whereNotNull('used_at')->count(),
            ],
        ]);
    }
}
