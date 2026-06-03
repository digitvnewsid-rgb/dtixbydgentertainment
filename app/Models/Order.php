<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_id',
        'event_id',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'payment_proof',
        'expired_at',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'integer',
            'payment_status' => PaymentStatus::class,
            'order_status' => OrderStatus::class,
            'expired_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
