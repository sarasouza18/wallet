<?php

namespace App\Repositories;

use App\Models\Cashbook;
use App\Repositories\Contracts\CashbookRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CashbookRepository implements CashbookRepositoryContract
{
    protected $model;

    public function __construct(Cashbook $cashbook)
    {
        $this->model = $cashbook;
    }

    public function findBy(string $attribute, mixed $value): Model
    {
        return $this->model->where($attribute, $value)->first();
    }

    public function delete(Model|int $model): ?bool
    {
        if ($model instanceof Model) {
            return $model->delete();
        }

        return $this->model::findOrFail($model)->delete();
    }

    public function store(array $data): Model
    {
        $walletId = Arr::get($data,'wallet_id');
        $transactionId = Arr::get($data, 'transaction_id');
        $amount = Arr::get($data, 'amount');
        $operation = Arr::get($data, 'operation');

        $cashbook = new Cashbook();
        $cashbook->wallet_id = $walletId;
        $cashbook->transaction_id = $transactionId;
        $operation == Cashbook::DEDUCT ? $cashbook->amount = - ($amount) : $cashbook->amount = $amount;
        $cashbook->save();

        return $cashbook;
    }

    public function update(Model|int $model, array $attributes = [], array $options = []): bool
    {
        if ($model instanceof Model) {
            return $model->update($attributes, $options);
        }

        return $this->model::query()
            ->whereKey($model)
            ->update($attributes, $options);
    }

    public function exists(string $attribute, $value): bool
    {
        return $this->model::where($attribute, $value)->exists();
    }
}
