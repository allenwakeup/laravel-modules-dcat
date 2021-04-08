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

        $this->initRoute ();
    }

    protected function initRoute ()
    {
        $this->path = goodcatch_vendor_path ('/laravel-modules-dcat/routes');
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

        if (config('admin.helpers.enable', true) && config('app.debug')) {
            return;
        }

        $attributes = [
            'prefix'     => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ];

        Route::group($attributes, function ($router) {
            $router->get('helpers/scaffold-modules', 'Goodcatch\Modules\Dcat\Http\Controllers\ScaffoldController@index');
            $router->post('helpers/scaffold-modules', 'Goodcatch\Modules\Dcat\Http\Controllers\ScaffoldController@store');
            $router->post('helpers/scaffold/table-modules', 'Goodcatch\Modules\Dcat\Http\Controllers\ScaffoldController@table');
            $router->get('helpers/icons-modules', 'Goodcatch\Modules\Dcat\Http\Controllers\IconController@index');
        });

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
        Route::prefix ('web')
            ->middleware ('web')
            ->group ($this->getPath ('web'));
    }

}
