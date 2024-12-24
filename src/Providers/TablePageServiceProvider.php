<?php

namespace Lexxkrt\TablePage\Providers;

use Illuminate\Support\ServiceProvider;

class TablePageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->commands([\Lexxkrt\TablePage\Console\Commands\MakePage::class]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'table-page');
    }
}
