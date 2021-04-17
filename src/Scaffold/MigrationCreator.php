<?php

namespace Goodcatch\Modules\DcatAdmin\Scaffold;

use Dcat\Admin\Scaffold\MigrationCreator as Creator;

class MigrationCreator extends Creator
{

    use ModuleCreator;

    /**
     * Get the full path to the migration.
     *
     * @param  string  $name
     * @param  string  $path
     * @return string
     */
    protected function getPath($name, $path)
    {
        if(isset($this->module)){
            $path = module_path($this->module, '/database/migrations');
        }

        return $path.'/'.$this->getDatePrefix().'_'.$name.'.php';
    }
}
