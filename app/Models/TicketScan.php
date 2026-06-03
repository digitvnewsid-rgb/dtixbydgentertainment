<?php

namespace App\Models;

use App\Enums\ScanStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketScan extends Model
{
    protected $fillable = [
        'ticket_id',
        'event_id',
        'scanned_by',
        'scan_status',
        'scan_message',
        'scanned_at',
    ];

    protected function casts(): array
    {
        return [
            'scan_status' => ScanStatus::class,
            'scanned_at' => 'datetime',
        ];
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function scanner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'scanned_by');
    }
}
