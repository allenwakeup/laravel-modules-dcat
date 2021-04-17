<?php

namespace Goodcatch\Modules\DcatAdmin\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	use HasDateTimeFormatter;

	const TYPE_BUILD_IN         = 0;
	const TYPE_EXTERNAL         = 1;

	const STATUS_DISABLE        = 0;
	const STATUS_ENABLE         = 1;

    public $timestamps = false;

    protected $table = 'gc_modules';

}
