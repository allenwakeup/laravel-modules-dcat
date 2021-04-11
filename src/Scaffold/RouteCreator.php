<?php

namespace Goodcatch\Modules\Dcat\Scaffold;

use Dcat\Admin\Exception\AdminException;
use Dcat\Admin\Support\Helper;
use Goodcatch\Modules\Facades\Module;
use Illuminate\Support\Str;

class RouteCreator
{
    use ModuleCreator;


    /**
     * Model name.
     *
     * @var string
     */
    protected $name;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * ModelCreator constructor.
     *
     * @param string $name
     * @param null   $files
     */
    public function __construct($name, $files = null)
    {
        $this->name = $name;

        $this->files = $files ?: app('files');
    }

    /**
     * Create a new route file.
     * @param string $controller controller class name
     * @throws \Exception
     *
     * @return string
     */
    public function create($controller)
    {
        $path = $this->getpath($this->name);
        $dir = dirname($path);

        if (! is_dir($dir)) {
            $this->files->makeDirectory($dir, 0755, true);
        }

        if ($this->files->exists($path)) {
            throw new AdminException("Route [$this->name] already exists!");
        }

        $stub = $this->files->get($this->getStub());

        $stub = $this->replaceModelName($stub, $this->name)
            ->replaceController($stub, $controller);

        $this->files->put($path, $stub);
        $this->files->chmod($path, 0777);

        return $path;
    }

    /**
     * Get path for route file.
     *
     * @param string $name
     *
     * @return string
     */
    public function getPath($name)
    {
        if(isset($this->module)){
            $module = Module::findByAlias($this->module);
            if(isset($module)){
                return $module->getPath() . '/routes/auto/' . Helper::slug($name);
            }
        }
        return '';
    }

    /**
     * Replace Model name.
     *
     * @param string $stub
     *
     * @return $this
     */
    public function replaceModelName(&$stub, $name)
    {

        $name = str_replace('.php', '', $name);
        $stub = str_replace('DummyModelName', Str::plural($name), $stub);

        return $this;
    }

    /**
     * Replace controller.
     *
     * @param string $stub
     *
     * @return $this
     */
    public function replaceController(&$stub, $name)
    {
        return str_replace('DummyClass', $name, $stub);
    }

    /**
     * Get stub path of model.
     *
     * @return string
     */
    public function getStub()
    {
        return __DIR__.'/stubs/route.stub';
    }

}
