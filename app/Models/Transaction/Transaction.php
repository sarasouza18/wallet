<?php

namespace App\Models\Transaction;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * @var array
     */
    protected $fillable = [
        'wallet_id',
        'wallet_payee_id',
        'type_id',
        'status_id',
        'amount',
    ];

    /**
     * Status relation
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    /**
     * Type relation
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    /**
     * Wallet Relation
     *
     * @return BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * Wallet Relation
     *
     * @return BelongsTo
     */
    public function walletPayee(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
