<?php

namespace App\Providers;

use App\Services\Contracts\WalletServiceContract;
use App\Services\WalletService;
use Illuminate\Support\ServiceProvider;

class WalletServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            WalletServiceContract::class,
            WalletService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [WalletServiceContract::class];
    }
}
