<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wallet extends Model
{
    protected $fillable = [
        'address',
        'name',
        'eth_balance',
        'last_checked_at',
    ];

    protected $casts = [
        'eth_balance' => 'decimal:18',
        'last_checked_at' => 'datetime',
    ];

    public function tokens(): BelongsToMany
    {
        return $this->belongsToMany(Token::class, 'wallet_tokens')
            ->withPivot('balance', 'last_checked_at')
            ->withTimestamps();
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
