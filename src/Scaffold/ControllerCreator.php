<?php

namespace Goodcatch\Modules\DcatAdmin\Scaffold;

use Dcat\Admin\Scaffold\ControllerCreator as Creator;

class ControllerCreator extends Creator
{
    use ModuleCreator;

    /**
     * @param string $primaryKey
     * @param array  $fields
     * @param bool   $timestamps
     *
     * @return string
     */
    protected function generateForm(string $primaryKey = null, array $fields = [], $timestamps = null)
    {
        $primaryKey = $primaryKey ?: request('primary_key', 'id');
        $fields = $fields ?: request('fields', []);
        $timestamps = $timestamps === null ? request('timestamps') : $timestamps;

        $rows = [
            <<<EOF
\$form->display('{$primaryKey}');
EOF

        ];

        foreach ($fields as $field) {
            if (empty($field['name'])) {
                continue;
            }

            if ($field['name'] == $primaryKey) {
                continue;
            }

            $rows[] = "            \$form->text('{$field['name']}', module_admin_trans_label('{$field['name']}'));";
        }
        if ($timestamps) {
            $rows[] = <<<'EOF'
        
            $form->display('created_at');
            $form->display('updated_at');
EOF;
        }

        return implode("\n", $rows);
    }

    /**
     * @param string $primaryKey
     * @param array  $fields
     *
     * @return string
     */
    protected function generateGrid(string $primaryKey = null, array $fields = [], $timestamps = null)
    {
        $primaryKey = $primaryKey ?: request('primary_key', 'id');
        $fields = $fields ?: request('fields', []);
        $timestamps = $timestamps === null ? request('timestamps') : $timestamps;

        $rows = [
            "\$grid->column('{$primaryKey}', module_admin_trans_field('{$primaryKey}'))->sortable();",
        ];

        foreach ($fields as $field) {
            if (empty($field['name'])) {
                continue;
            }

            if ($field['name'] == $primaryKey) {
                continue;
            }

            $rows[] = "            \$grid->column('{$field['name']}', module_admin_trans_field('{$field['name']}'));";
        }

        if ($timestamps) {
            $rows[] = '            $grid->column(\'created_at\');';
            $rows[] = '            $grid->column(\'updated_at\')->sortable();';
        }

        $rows[] = <<<EOF
        
            \$grid->filter(function (Grid\Filter \$filter) {
                \$filter->equal('$primaryKey');
        
            });
EOF;

        return implode("\n", $rows);
    }

    /**
     * @param string $primaryKey
     * @param array  $fields
     *
     * @return string
     */
    protected function generateShow(string $primaryKey = null, array $fields = [], $timestamps = null)
    {
        $primaryKey = $primaryKey ?: request('primary_key', 'id');
        $fields = $fields ?: request('fields', []);
        $timestamps = $timestamps === null ? request('timestamps') : $timestamps;

        $rows = [];

        if ($primaryKey) {
            $rows[] = "            \$show->field('{$primaryKey}', module_admin_trans_label('{$primaryKey}'));";
        }

        foreach ($fields as $k => $field) {
            if (empty($field['name'])) {
                continue;
            }

            $rows[] = "            \$show->field('{$field['name']}', module_admin_trans_label('{$field['name']}'));";

//            if ($k === 1 && (count($fields) > 2 || $timestamps)) {
//                $rows[] = '            $show->divider();';
//            }
        }

        if ($timestamps) {
            $rows[] = '            $show->field(\'created_at\');';
            $rows[] = '            $show->field(\'updated_at\');';
        }

        return trim(implode("\n", $rows));
    }
}
