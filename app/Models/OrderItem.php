<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'ticket_type_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'price' => 'integer',
            'subtotal' => 'integer',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }
}
