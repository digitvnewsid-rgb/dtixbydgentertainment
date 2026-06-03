<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'method',
        'status',
        'proof_path',
        'validated_by',
        'validated_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'status' => PaymentStatus::class,
            'validated_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
