<?php

namespace App\Repositories;

use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionStatus;
use App\Models\Transaction\TransactionType;
use App\Repositories\Contracts\TransactionRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class TransactionRepository implements TransactionRepositoryContract
{
    protected $model;

    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
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
        return Transaction::create([
            'wallet_id' => Arr::get($data, 'wallet_id'),
            'wallet_payee_id' => Arr::get($data, 'wallet_payee_id'),
            'type_id' => TransactionType::TRANSFER,
            'status_id' => TransactionStatus::PROCESSING,
            'amount' => Arr::get($data, 'amount')
        ]);
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
