<?php

namespace Goodcatch\Modules\Dcat\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	use HasDateTimeFormatter;
    public $timestamps = false;

    protected $table = 'gc_modules';

}
