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
        $this->app->bind(
            IEntity::class,
            Entity::class
        );

        $this->app->bind(
            Entity::class,
            UserEntity::class
        );
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
