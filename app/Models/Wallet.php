<?php

namespace App\Models;

use App\Models\Transaction\Transaction;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Wallet extends Model
{
    use HasFactory, Notifiable;

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'balance',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return BelongsTo
     */
    public function cashbook(): BelongsTo
    {
        return $this->belongsTo(Cashbook::class);
    }
}
