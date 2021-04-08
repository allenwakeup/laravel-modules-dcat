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
    protected $namespace = 'Goodcatch\\Modules\\Dcat\\Http\\Controllers\\';

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
        $this->mapWebRoutes();
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
            ->namespace ($this->namespace)
            ->group ($this->getPath ('web'));
    }

}
