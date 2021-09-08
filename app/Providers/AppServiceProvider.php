<?php

namespace App\Providers;

use App\Helpers\UtilHelperClass;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('UtilHelper',function() {
            return new UtilHelperClass();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
