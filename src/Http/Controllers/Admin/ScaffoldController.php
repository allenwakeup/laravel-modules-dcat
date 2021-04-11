<?php

namespace Goodcatch\Modules\Dcat\Http\Controllers\Admin;

use Dcat\Admin\Admin;
use Dcat\Admin\Http\Auth\Permission;
use Dcat\Admin\Http\Controllers\ScaffoldController as Controller;
use Dcat\Admin\Layout\Content;
use Goodcatch\Modules\Dcat\Scaffold\ControllerCreator;
use Goodcatch\Modules\Dcat\Scaffold\LangCreator;
use Goodcatch\Modules\Dcat\Scaffold\MigrationCreator;
use Goodcatch\Modules\Dcat\Scaffold\ModelCreator;
use Goodcatch\Modules\Dcat\Scaffold\RepositoryCreator;
use Goodcatch\Modules\Dcat\Scaffold\RouteCreator;
use Dcat\Admin\Support\Helper;
use Goodcatch\Modules\Dcat\Scaffold\RouterCreator;
use Goodcatch\Modules\Facades\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;

class ScaffoldController extends Controller
{

    public function index(Content $content)
    {
        if (! config('app.debug')) {
            Permission::error();
        }

        if ($tableName = request('singular')) {
            return $this->singular($tableName);
        }

        Admin::requireAssets('select2');
        Admin::requireAssets('sortable');

        $dbTypes = static::$dbTypes;
        $dataTypeMap = static::$dataTypeMap;
        $action = URL::current();
        $modules = Module::collections();
        $tables = collect($this->getDatabaseColumns())->map(function ($v) {
            return array_keys($v);
        })->toArray();

        return $content
            ->title(trans('admin.scaffold.header'))
            ->description(' ')
            ->body(view(
                'dcat::admin.helpers.scaffold',
                compact('dbTypes', 'action', 'modules', 'tables', 'dataTypeMap')
            ));
    }


    public function store(Request $request)
    {
        if (! config('app.debug')) {
            Permission::error();
        }

        $paths = [];
        $message = '';

        $creates = (array) $request->get('create');
        $table = Helper::slug($request->get('table_name'), '_');
        $module = $request->get('exist-module');
        $controller = $request->get('controller_name');
        $model = $request->get('model_name');
        $repository = $request->get('repository_name');

        try {
            // 1. Create model.
            if (in_array('model', $creates)) {
                $modelCreator = new ModelCreator($table, $model);

                $paths['model'] = $modelCreator->withModule($module)->create(
                    $request->get('primary_key'),
                    $request->get('timestamps') == 1,
                    $request->get('soft_deletes') == 1
                );
            }

            // 2. Create controller.
            if (in_array('controller', $creates)) {
                $paths['controller'] = (new ControllerCreator($controller))->withModule($module)
                    ->create(in_array('repository', $creates) ? $repository : $model);
            }

            // 3. Create route.
            if (in_array('route', $creates)) {
                $paths['route'] = (new RouteCreator(Helper::basename($paths['model']), app('files')))->withModule($module)
                    ->create($controller);
            }

            // 4. Create migration.
            if (in_array('migration', $creates)) {
                $migrationName = 'create_'.$table.'_table';

                $paths['migration'] = (new MigrationCreator(app('files')))->withModule($module)->buildBluePrint(
                    $request->get('fields'),
                    $request->get('primary_key', 'id'),
                    $request->get('timestamps') == 1,
                    $request->get('soft_deletes') == 1
                )->create($migrationName, database_path('migrations'), $table);
            }

            if (in_array('lang', $creates)) {
                $paths['lang'] = (new LangCreator($request->get('fields')))->withModule($module)
                    ->create($controller, $request->get('translate_title'));
            }

            if (in_array('repository', $creates)) {
                $paths['repository'] = (new RepositoryCreator(app('files')))->withModule($module)
                    ->create($model, $repository);
            }

            // Run migrate.
            if (in_array('migrate', $creates)) {
                Artisan::call('migrate');
                $message = Artisan::output();
            }

            // Make ide helper file.
            if (in_array('migrate', $creates) || in_array('controller', $creates)) {
                try {
                    Artisan::call('admin:ide-helper', ['-c' => $controller]);

                    $paths['ide-helper'] = 'dcat_admin_ide_helper.php';
                } catch (\Throwable $e) {
                }
            }
        } catch (\Exception $exception) {
            // Delete generated files if exception thrown.
            app('files')->delete($paths);

            return $this->backWithException($exception);
        }

        return $this->backWithSuccess($paths, $message);
    }
}
