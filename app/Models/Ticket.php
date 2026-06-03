<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_code',
        'order_id',
        'event_id',
        'ticket_type_id',
        'customer_id',
        'attendee_name',
        'attendee_email',
        'qr_token',
        'qr_code_path',
        'status',
        'used_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => TicketStatus::class,
            'used_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function scans(): HasMany
    {
        return $this->hasMany(TicketScan::class);
    }
}
