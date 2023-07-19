<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    use HasFactory;

    public const PROCESSING = 1;

    public const SUCCESS = 2;

    public const FAILED = 3;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];
}
