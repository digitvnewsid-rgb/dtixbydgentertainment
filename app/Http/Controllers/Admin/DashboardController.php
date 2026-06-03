<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'events' => Event::count(),
                'creators' => User::where('role', UserRole::Creator)->count(),
                'customers' => User::where('role', UserRole::Customer)->count(),
                'tickets_sold' => Ticket::count(),
                'orders_pending' => Order::where('payment_status', PaymentStatus::Pending)->count(),
                'orders_paid' => Order::where('payment_status', PaymentStatus::Paid)->count(),
                'revenue' => Order::where('payment_status', PaymentStatus::Paid)->sum('total_amount'),
                'check_ins' => Ticket::whereNotNull('used_at')->count(),
            ],
        ]);
    }
}
