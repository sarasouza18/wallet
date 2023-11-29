<?php

namespace App\Providers;

use App\Repositories\Contracts\WalletRepositoryContract;
use App\Repositories\WalletRepository;
use Illuminate\Support\ServiceProvider;

class WalletRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            WalletRepositoryContract::class,
            WalletRepository::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [WalletRepositoryContract::class];
    }
}
