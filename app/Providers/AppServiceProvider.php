<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Restaurant;
use App\RestaurantPhoto;
use App\Observers\RestaurantObserver;
use App\Observers\RestaurantPhotoObserver;

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

    public function boot()
    {
        Restaurant::observe(RestaurantObserver::class);
        RestaurantPhoto::observe(RestaurantPhotoObserver::class);
    }
}
