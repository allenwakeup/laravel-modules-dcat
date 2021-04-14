<?php


namespace Goodcatch\Modules\Dcat\Contracts\Permission;

use Goodcatch\Modules\Laravel\Contracts\Auth\PermissionProvider as Permission;
use Illuminate\Contracts\Foundation\Application;

/**
 * 在laravel-modules项目中会根据下面的环境变量
 *
 * MODULE_INTEGRATE=dcat
 *
 * 找到此类并实例化放在容器中，其他模块可以在调用中随意使用。
 *
 * Class PermissionProvider
 * @package Goodcatch\Modules\Dcat\Contracts\Permission
 */
class PermissionProvider implements Permission
{

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The provider driver name.
     *
     * @var string
     */
    protected $driver;

    /**
     * Create a new Auth manager instance.
     *
     * @param  Application  $app
     * @param  string $driver
     * @return void
     */
    public function __construct($app, $driver)
    {
        $this->app = $app;
        $this->driver = $driver;
    }

    /**
     * @inheritDoc
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        // TODO: Implement query() method.
    }

    /**
     * @inheritDoc
     */
    public function save(array $values, array $unique)
    {
        // TODO: Implement save() method.
    }

    /**
     * @inheritDoc
     */
    public function find($condition)
    {
        // TODO: Implement find() method.
    }

    /**
     * @inheritDoc
     */
    public function retrieve($condition)
    {
        // TODO: Implement retrieve() method.
    }

    /**
     * @inheritDoc
     */
    public function flush()
    {
        // TODO: Implement flush() method.
    }
}