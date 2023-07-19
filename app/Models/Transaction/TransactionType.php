<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    public const TRANSFER = 1;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];
}
