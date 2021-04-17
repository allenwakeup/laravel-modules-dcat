<?php


namespace Goodcatch\Modules\DcatAdmin\Scaffold;


use Dcat\Admin\Support\Helper;
use Goodcatch\Modules\Facades\Module;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

trait ModuleCreator
{

    protected $module;

    public function withModule($module) {
        $this->module = $module;
        return $this;
    }

    /**
     * Get path for migration file.
     *
     * @param string $name
     *
     * @return string
     * @throws \ReflectionException
     */
    public function getPath($name)
    {
        if(isset($this->module)){
            $module = Module::find($this->module);
            if(isset($module)){
                return str_replace(
                    base_path(),
                    $module->getPath() . '/src' ,
                    Helper::guessClassFileName(str_replace(
                        config('modules.namespace') . '\\' . Str::ucfirst($this->module),
                        '',
                        $name)
                    )
                );
            }
        }
        return Helper::guessClassFileName($name);
    }


    /**
     * 获取语言包路径.
     *
     * @param string $controller
     *
     * @return string
     */
    protected function getLangPath(string $controller)
    {
        if(isset($this->module)){
            $module = Module::find($this->module);
            if(isset($module)){
                $path = $module->getPath() . '/resources/lang/' . App::getLocale();
            }
        } else {
            $path = resource_path('lang/'.App::getLocale());
        }
        return $path.'/'.Helper::slug($controller).'.php';
    }
}
