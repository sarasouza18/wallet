<?php

namespace App\Providers;

use App\Services\Contracts\TransferServiceContract;
use App\Services\TransferService;
use Illuminate\Support\ServiceProvider;

class TransferServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TransferServiceContract::class,
            TransferService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [TransferServiceContract::class];
    }
}
