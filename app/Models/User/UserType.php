<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    public const CUSTOMER = 1;
    public const SHOPKEEPERS = 2;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

}
