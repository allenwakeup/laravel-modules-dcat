<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Dcat\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $path;

    protected $config;

    protected $prefix;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct ($app)
    {
        parent::__construct ($app);

        $this->config = $this->app ['config']->get ('modules', []);

        $this->path = module_path($this->moduleName, 'routes');
    }

    protected function getModuleConfig ($key, $default)
    {
        return Arr::get ($this->config, $key, $default);
    }

    protected function getPath ($name = null)
    {
        return $this->path . '/' . (isset ($name) ? $name : 'web') . '.php';
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map ()
    {
        $this->mapHelperRoutes();
        $this->mapAdminRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "helper" routes for the Dcat Admin Modules.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapHelperRoutes ()
    {

        if (! config('admin.helpers.enable', true) || ! config('app.debug')) {
            return;
        }

        Route::prefix(config('admin.route.prefix'))
            ->middleware(config('admin.route.middleware'))
            ->group(function ($router) {
                $router->get('goodcatch/laravel-modules/scaffold', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ScaffoldController@index');
                $router->post('goodcatch/laravel-modules/scaffold', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ScaffoldController@store');
            });

    }


    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes ()
    {

        Route::prefix(config('admin.route.prefix'))
            ->middleware(config('admin.route.middleware'))
            ->group ($this->getPath('admin'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapWebRoutes ()
    {

        Route::middleware('web')
            ->group ($this->getPath('web'));
    }

}
