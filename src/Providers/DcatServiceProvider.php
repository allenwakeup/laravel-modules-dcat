<?php

namespace Goodcatch\Modules\Dcat\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class DcatServiceProvider
 *
 * the main service provider that configured, so that laravel-modules requires.
 *
 * @package Goodcatch\Modules\Dcat\Providers
 */
class DcatServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ResourcesServiceProvider::class);
    }



    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $this->loadTranslationsFrom(
            goodcatch_vendor_path('/laravel-modules-dcat/resources/lang'),
            'dcat'
        );
    }


}
