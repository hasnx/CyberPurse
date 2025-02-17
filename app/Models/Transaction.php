<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'hash',
        'from_address',
        'to_address',
        'value',
        'token_id',
        'block_number',
        'transaction_date',
        'status',
        'raw_data',
    ];

    protected $casts = [
        'value' => 'decimal:18',
        'transaction_date' => 'datetime',
        'raw_data' => 'json',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function token(): BelongsTo
    {
        return $this->belongsTo(Token::class);
    }
}
