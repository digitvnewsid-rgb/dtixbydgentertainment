<?php

namespace App\Http\Controllers\Ticketing;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketScan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $assignedEventIds = $user->assignedEvents()->pluck('events.id');

        return view('ticketing.dashboard', [
            'events' => Event::whereIn('id', $assignedEventIds)->orderBy('start_datetime')->get(),
            'stats' => [
                'assigned_events' => $assignedEventIds->count(),
                'checked_in' => Ticket::whereIn('event_id', $assignedEventIds)->whereNotNull('used_at')->count(),
                'scans_today' => TicketScan::where('scanned_by', $user->id)->whereDate('scanned_at', today())->count(),
            ],
        ]);
    }
}
