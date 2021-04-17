<?php

namespace Goodcatch\Modules\DcatAdmin\Scaffold;

use Dcat\Admin\Exception\AdminException;
use Dcat\Admin\Scaffold\RepositoryCreator as Creator;

class RepositoryCreator extends Creator
{

    use ModuleCreator;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * RepositoryCreator constructor.
     *
     * @param string $name
     * @param null   $files
     */
    public function __construct($files = null)
    {
        $this->files = $files ?: app('files');
    }

    /**
     * @param string $modelClass
     * @param string $repositoryClass
     * @throws \Exception
     * @return string
     */
    public function create(?string $modelClass, ?string $repositoryClass)
    {
        $path = $this->getpath($repositoryClass);
        $dir = dirname($path);

        if (! is_dir($dir)) {
            $this->files->makeDirectory($dir, 0755, true);
        }

        if ($this->files->exists($path)) {
            throw new AdminException("Controller [$repositoryClass] already exists!");
        }

        $stub = $this->files->get($this->stub());

        $stub = str_replace([
            '{namespace}',
            '{class}',
            '{model}',
        ], [
            $this->getNamespace($repositoryClass),
            class_basename($repositoryClass),
            $modelClass,
        ], $stub);

        $this->files->put($path, $stub);

        $this->files->chmod($path, 0777);

        return $path;
    }
}
