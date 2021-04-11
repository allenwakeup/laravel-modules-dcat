<?php

namespace Goodcatch\Modules\Dcat\Repositories\Admin;

use Goodcatch\Modules\Dcat\Models\Module as Model;
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
