<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::component('components.navbar_link', 'navlink');
        Blade::component('components.language_option', 'langoption');
        Blade::component('components.big_statistic', 'bigstatistic');
        Blade::component('components.exclamosection', 'exclamosection');
        Blade::component('components.exclamoflexsection', 'exclamoflexsection');
        Blade::component('components.exclamocasemessages', 'exclamocasemessages');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

}