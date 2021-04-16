<?php


/**
 *
 * This file <admin.php> was created by <PhpStorm> at <2021/2/3>,
 * and it is part of project <core>.
 * @author  Allen Li <ali@goodcatch.cn>
 */


use Illuminate\Support\Str;

Route::group ([
    'as' => 'admin::'
], function (){
    $routes_path = __DIR__ . '/auto';
    if (is_dir ($routes_path)) {
        foreach (new DirectoryIterator ($routes_path) as $f) {
            if ($f->isDot()) {
                continue;
            }
            $name = $f->getPathname();
            if ($f->isFile() && Str::endsWith($name, '.php')) {
                require $name;
            }
        }
    }
});

