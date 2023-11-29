<?php

namespace App\Providers;

use App\Services\Contracts\CashbookServiceContract;
use App\Services\CashbookService;
use Illuminate\Support\ServiceProvider;

class CashbookServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CashbookServiceContract::class,
            CashbookService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [CashbookServiceContract::class];
    }
}
