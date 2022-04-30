<?php

namespace App\Providers;

use App\Services\BusinessServices\factory\EmailServices;
use App\Services\BusinessServices\IEmailServices;
use App\Services\BaseServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(IEmailServices::class, EmailServices::class);
        $this->app->singleton(BaseServices::class);

    }
}
