<?php

namespace App\Services\Validations;

use App\Services\Service;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class ValidateBalancePayer extends Service
{

    /**
     * @param float $balance
     * @param float $amount
     * @throws Exception
     */
    public function execute(float $balance, float $amount) : void
    {
        try {
            if ($amount > $balance) {
                throw new Exception('Wallet does not have enough balance.');
            }
        } catch (Throwable $e) {
            Log::info($e->getMessage(), ['code' => 'not_have_balance', 'exception' => $e,]);
            throw new Exception('Wallet does not have enough balance.');
        }
    }
}
