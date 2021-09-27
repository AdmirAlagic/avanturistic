<?php

namespace App\Providers;

use App\Helpers\UtilHelperClass;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App;
use App\Helpers\CurrencyHelperClass;

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
        App::bind('CurrencyHelper',function() {
            return new CurrencyHelperClass();
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
