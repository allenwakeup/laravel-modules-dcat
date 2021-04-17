<?php

namespace Goodcatch\Modules\DcatAdmin\Providers;

use Goodcatch\Modules\DcatAdmin\Layout\Menu;
use Illuminate\Support\ServiceProvider;

class ResourcesServiceProvider extends ServiceProvider
{


    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Dcat';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'dcat';

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
        // 重新定义单粒 Dcat\Admin\Layout\Menu
        $this->app->singleton('admin.menu', Menu::class);
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
        $this->loadViewsFrom(module_path($this->moduleName, 'resources/views'),'dcat');
    }
}
