<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $customerId = auth()->id();

        return view('customer.dashboard', [
            'stats' => [
                'orders' => Order::where('customer_id', $customerId)->count(),
                'tickets' => Ticket::where('customer_id', $customerId)->count(),
                'pending_payment' => Order::where('customer_id', $customerId)->where('payment_status', 'pending')->count(),
            ],
        ]);
    }
}
