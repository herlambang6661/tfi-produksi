<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->register(\Milon\Barcode\BarcodeServiceProvider::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('DNS1D', \Milon\Barcode\Facades\DNS1DFacade::class);
        $loader->alias('DNS2D', \Milon\Barcode\Facades\DNS2DFacade::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
    }
}
