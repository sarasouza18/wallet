<?php

namespace App\Providers;

use App\Repositories\Contracts\TransactionRepositoryContract;
use App\Repositories\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class TransactionRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TransactionRepositoryContract::class,
            TransactionRepository::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [TransactionRepositoryContract::class];
    }
}
