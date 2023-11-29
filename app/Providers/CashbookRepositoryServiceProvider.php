<?php

namespace App\Providers;

use App\Repositories\Contracts\CashbookRepositoryContract;
use App\Repositories\CashbookRepository;
use Illuminate\Support\ServiceProvider;

class CashbookRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CashbookRepositoryContract::class,
            CashbookRepository::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [CashbookRepositoryContract::class];
    }
}
