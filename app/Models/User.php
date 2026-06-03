<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'phone', 'password', 'role', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'is_active' => 'boolean',
        ];
    }

    public function createdEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'creator_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'customer_id');
    }

    public function ticketScans(): HasMany
    {
        return $this->hasMany(TicketScan::class, 'scanned_by');
    }

    public function assignedEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_ticketing_staff')
            ->withTimestamps();
    }

    public function isRole(UserRole $role): bool
    {
        return $this->role === $role;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }
}
