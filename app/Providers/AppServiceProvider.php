<?php

namespace App\Providers;

use App\CommandHandlers\Commands\CommandFactory;
use App\Contracts\User as UserContract;
use App\Repositories\UserRepository;
use App\Support\Common;
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
        $this->app->bind(UserContract::class, UserRepository::class);

        $this->app->bind("commandFactory", function(){
            return new CommandFactory();
        });

        $this->app->bind("common", function(){
            return new Common();
        });
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
