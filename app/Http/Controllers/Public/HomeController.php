<?php

namespace App\Http\Controllers\Public;

use App\Enums\EventStatus;
use App\Enums\TicketTypeStatus;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $events = Event::query()
            ->where('status', EventStatus::Published)
            ->where('end_datetime', '>=', now())
            ->with(['category', 'creator', 'ticketTypes' => fn ($q) => $q->where('status', TicketTypeStatus::Active)])
            ->orderBy('start_datetime')
            ->limit(6)
            ->get();

        return view('public.home', compact('events'));
    }
}
