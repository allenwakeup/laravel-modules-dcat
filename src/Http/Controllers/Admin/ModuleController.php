<?php

namespace Goodcatch\Modules\Dcat\Http\Controllers\Admin;

use Goodcatch\Modules\Dcat\Models\Module;
use Goodcatch\Modules\Dcat\Repositories\Admin\ModuleRepository;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ModuleController extends AdminController
{

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return $this->title ?: module_admin_trans_label();
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ModuleRepository(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name', module_admin_trans_field('name'));
            $grid->column('alias', module_admin_trans_field('alias'));
            $grid->column('description', module_admin_trans_field('description'));
            $grid->column('priority', module_admin_trans_field('priority'))->editable(true);
            $grid->column('version', module_admin_trans_field('version'));
            $grid->column('path', module_admin_trans_field('path'));
            $grid->column('type', module_admin_trans_field('type'))->display(function ($type) {
                return module_admin_trans_option($type, 'type');
            });
            $grid->column('sort', module_admin_trans_field('sort'));
            $grid->column('status', module_admin_trans_field('status'))->switch('green', true);

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new ModuleRepository(), function (Show $show) {
            $show->row(function (Show\Row $show) {
                $show->width(6)->field('id');
                $show->width(6)->field('name', module_admin_trans_label('name'));

            });
            $show->row(function (Show\Row $show) {
                $show->width(6)->field('alias', module_admin_trans_label('alias'));
                $show->width(6)->field('description', module_admin_trans_label('description'));
            });
            $show->row(function (Show\Row $show) {
                $show->width(6)->field('priority', module_admin_trans_label('priority'));
                $show->width(6)->field('version', module_admin_trans_label('version'));
            });
            $show->row(function (Show\Row $show) {
                $show->width(6)->field('type', module_admin_trans_label('type'))->as(function ($type) {
                    return module_admin_trans_option($type, 'type');
                });
                $show->width(6)->field('status', module_admin_trans_label('status'))->as(function ($status) {
                    return module_admin_trans_option($status, 'status');
                });
            });
            $show->row(function (Show\Row $show) {
                $show->width(6)->field('sort', module_admin_trans_label('sort'));
                $show->width(6)->field('path', module_admin_trans_label('path'));
            });
            $show->row(function (Show\Row $show) {
                $show->width(6)->field('created_at');
                $show->width(6)->field('updated_at');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new ModuleRepository(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('alias', module_admin_trans_label('alias'))->required();
            $form->text('description', module_admin_trans_label('description'));
            $form->text('priority', module_admin_trans_label('priority'));
            $form->text('version', module_admin_trans_label('version'));
            $form->text('path', module_admin_trans_label('path'))->disable();
            $form->radio('type', module_admin_trans_label('type'))->options([
                Module::TYPE_BUILD_IN => module_admin_trans_option(Module::TYPE_BUILD_IN, 'type'),
                Module::TYPE_EXTERNAL => module_admin_trans_option(Module::TYPE_EXTERNAL, 'type')
            ]);
            $form->text('sort', module_admin_trans_label('sort'))->default(1);
            $form->switch('status')
                ->customFormat(function ($v) {
                    return $v == Module::STATUS_ENABLE
                        ? Module::STATUS_ENABLE
                        : Module::STATUS_DISABLE;
                })->saving(function ($v) {
                    return $v
                        ? Module::STATUS_ENABLE
                        : Module::STATUS_DISABLE;
                });
        });
    }
}
