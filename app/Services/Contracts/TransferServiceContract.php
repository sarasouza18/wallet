<?php

namespace App\Services\Contracts;

use App\Models\Transaction\Transaction;

interface TransferServiceContract
{
    public function transfer(array $data): Transaction;

}
