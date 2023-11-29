<?php

namespace App\Services;

use App\Models\Cashbook;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionStatus;
use App\Models\Wallet;
use App\Proxys\MockyProxy;
use App\Repositories\Contracts\TransactionRepositoryContract;
use App\Services\Contracts\CashbookServiceContract;
use App\Services\Contracts\TransferServiceContract;
use App\Services\Contracts\WalletServiceContract;
use App\Services\Validations\ValidateBalancePayer;
use App\Services\Validations\ValidateUserType;
use Exception;

class TransferService implements TransferServiceContract
{

    public function transfer(array $data): Transaction
    {
        $wallet = Wallet::find($data['wallet_id']);
        $walletPayee = Wallet::find($data['wallet_payee_id']);

        $this->validations($wallet->user->type->id, $wallet->balance, $data);

        $this->auth();


        $transaction = app(TransactionRepositoryContract::class)->store($data);

        app(WalletServiceContract::class)->deductBalance($wallet->id, $data['amount']);

        app(CashbookServiceContract::class)->store($wallet->id, Cashbook::DEDUCT, $data['amount'], $transaction->id);

        app(WalletServiceContract::class)->addBalance($walletPayee->id, $data['amount']);

        app(CashbookServiceContract::class)->store($walletPayee->id, Cashbook::ADD, $data['amount'], $transaction->id);

        $this->notify($transaction);

        return $transaction;
    }

    /**
     * @return void
     * @throws Exception
     */
    private function auth(): void
    {
        $auth = app(MockyProxy::class)->authorization();

        if (!$auth) {
            throw new Exception('not authorization');
        }
    }

    /**
     * @param Transaction $transaction
     * @return void
     */
    private function notify(Transaction $transaction): void
    {
        $notify = app(MockyProxy::class)->notify();

        if ($notify) {
            $transaction->status_id = TransactionStatus::SUCCESS;
        } else {
            $transaction->status_id = TransactionStatus::FAILED;
        }
        $transaction->save();
    }

    /**
     * @param string $typeId
     * @param float $balance
     * @param array $data
     * @return void
     */
    private function validations(string $typeId, float $balance, array $data): void
    {
        app(ValidateUserType::class)->execute($typeId);

        app(ValidateBalancePayer::class)->execute($balance, $data['amount']);
    }
}
