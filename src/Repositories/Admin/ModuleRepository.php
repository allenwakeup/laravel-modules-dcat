<?php

namespace Goodcatch\Modules\DcatAdmin\Repositories\Admin;

use Goodcatch\Modules\DcatAdmin\Models\Module as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ModuleRepository extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
