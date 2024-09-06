<?php

namespace App\Providers;

use App\Http\Resources\Event\MiniEventResource;
use App\Http\Resources\Event\UserEventResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UserEventResource::withoutWrapping();
        UserResource::withoutWrapping();
        MiniEventResource::withoutWrapping();
    }
}
