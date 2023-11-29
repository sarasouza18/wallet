<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Contracts\WalletRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class WalletRepository implements WalletRepositoryContract
{
    protected $model;

    /**
     * @param Wallet $wallet
     */
    public function __construct(Wallet $wallet)
    {
        $this->model = $wallet;
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
        return $this->model::create($data);
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
