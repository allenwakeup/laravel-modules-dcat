<?php
Route::get('goodcatch/laravel-modules/modules', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@index');
Route::post('goodcatch/laravel-modules/modules', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@store');
