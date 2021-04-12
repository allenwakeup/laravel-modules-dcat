<?php
Route::get('goodcatch/laravel-modules/modules', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@index');
Route::get('goodcatch/laravel-modules/modules/create', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@form');
Route::get('goodcatch/laravel-modules/modules/{id}/edit', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@edit');
Route::get('goodcatch/laravel-modules/modules/{id}', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@show');
Route::post('goodcatch/laravel-modules/modules', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@store');
Route::put('goodcatch/laravel-modules/modules/{id}', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@update');
// Route::delete('goodcatch/laravel-modules/modules/{id}', 'Goodcatch\Modules\Dcat\Http\Controllers\Admin\ModuleController@destroy');
