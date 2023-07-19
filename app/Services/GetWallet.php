<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Support\Arr;

class GetWallet extends Service
{
    /**
     * Create an activity type.
     *
     * @param array $data
     *
     * @return Wallet
     */
    public function execute(array $data): Wallet
    {
        $wallet = Wallet::find(Arr::get($data,'id'));
        $wallet->save();

        return $wallet;
    }

}
