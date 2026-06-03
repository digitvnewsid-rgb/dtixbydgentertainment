<?php

namespace App\Models;

use App\Enums\EventStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'creator_id',
        'category_id',
        'title',
        'slug',
        'description',
        'banner',
        'location',
        'map_url',
        'start_datetime',
        'end_datetime',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_datetime' => 'datetime',
            'end_datetime' => 'datetime',
            'status' => EventStatus::class,
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ticketTypes(): HasMany
    {
        return $this->hasMany(TicketType::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketingStaff(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_ticketing_staff')
            ->withTimestamps();
    }

    public function isPublished(): bool
    {
        return $this->status === EventStatus::Published;
    }

    public function isPurchasable(): bool
    {
        return $this->status === EventStatus::Published
            && $this->end_datetime->isFuture();
    }
}
