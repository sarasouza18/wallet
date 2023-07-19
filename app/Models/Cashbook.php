<?php

namespace App\Models;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cashbook extends Model
{
    use HasFactory;

    public const DEDUCT = 1;

    public const ADD = 2;

    /**
     * @var array
     */
    protected $fillable = [
        'wallet_id',
        'transaction_id',
        'amount',
    ];

    /**
     * Wallet relation
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * Transaction relation
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
