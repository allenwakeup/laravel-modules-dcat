<?php

namespace Goodcatch\Modules\Dcat\Providers;

use Illuminate\Support\ServiceProvider;

class ResourcesServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot ()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register ()
    {

        $this->registerViews ();
    }

    public function registerViews ()
    {
        if ($this->app->runningInConsole ()) {
//            $src = goodcatch_vendor_path ('/laravel-modules-dcat');
//            $this->publishes ([
//                $src . '/resources' =>  resource_path(),
//                $src . '/routes/web.php' => base_path('routes/web.php')
//            ], 'goodcatch-modules-dcat');
        }
    }

}
