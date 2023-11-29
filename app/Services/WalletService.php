<?php

namespace App\Services;

use App\Models\Wallet;
use App\Repositories\Contracts\WalletRepositoryContract;
use App\Services\Contracts\WalletServiceContract;
use Illuminate\Database\Eloquent\Model;

class WalletService implements WalletServiceContract
{
    public function __construct(WalletRepositoryContract $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function store(array $data): Model
    {
        return $this->walletRepository->store($data);
    }

    public function addBalance(int $walletId, float $amount): Wallet
    {
        $wallet = Wallet::find($walletId);
        $wallet->balance += $amount;
        $wallet->save();

        return $wallet;
    }

    public function deductBalance(int $walletId, float $amount): Wallet
    {
        $wallet = Wallet::find($walletId);
        $wallet->balance -= $amount;
        $wallet->save();

        return $wallet;
    }
}
