<?php

namespace Goodcatch\Modules\Dcat\Http\Controllers\Admin;

use Goodcatch\Modules\Dcat\Repositories\Admin\ModuleRepository;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ModuleController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ModuleRepository(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('alias');
            $grid->column('description');
            $grid->column('priority');
            $grid->column('version');
            $grid->column('path');
            $grid->column('type');
            $grid->column('sort');
            $grid->column('status');
        
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
            $show->field('id');
            $show->field('name');
            $show->field('alias');
            $show->field('description');
            $show->field('priority');
            $show->field('version');
            $show->field('path');
            $show->field('type');
            $show->field('sort');
            $show->field('status');
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
            $form->text('name');
            $form->text('alias');
            $form->text('description');
            $form->text('priority');
            $form->text('version');
            $form->text('path');
            $form->text('type');
            $form->text('sort');
            $form->text('status');
        });
    }
}
