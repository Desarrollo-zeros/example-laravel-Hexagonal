<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use src\Domain\Base\Entity;
use src\Domain\Base\IEntity;
use src\Domain\Entity\UserEntity\UserEntity;
use function foo\func;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
