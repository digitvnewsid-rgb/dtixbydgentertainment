<?php

namespace App\Models;

use App\Enums\TicketTypeStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketType extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quota',
        'sold',
        'max_purchase',
        'sale_start',
        'sale_end',
        'benefits',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'quota' => 'integer',
            'sold' => 'integer',
            'max_purchase' => 'integer',
            'sale_start' => 'datetime',
            'sale_end' => 'datetime',
            'status' => TicketTypeStatus::class,
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function remainingQuota(): int
    {
        return max(0, $this->quota - $this->sold);
    }
}
