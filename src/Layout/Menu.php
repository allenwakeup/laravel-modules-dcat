<?php

namespace Goodcatch\Modules\Dcat\Layout;

use Dcat\Admin\Layout\Menu as Layout;
use Lang;

class Menu extends Layout
{
    /**
     * Register menu.
     */
    public function register()
    {
        parent::register();

        $this->add([
            [
                'id'        => 1,
                'title'     => 'Laravel Modules',
                'icon'      => 'fa fa-cubes',
                'uri'       => '',
                'parent_id' => 0,
            ],
            [
                'id'        => 2,
                'title'     => 'Module',
                'icon'      => 'fa fa-cube',
                'uri'       => 'goodcatch/laravel-modules/modules',
                'parent_id' => 1,
            ]
        ], 20);

        if (config('app.debug') && config('admin.helpers.enable', true)) {
            $this->add([
                [
                    'id'        => 1,
                    'title'     => 'Helpers Modules',
                    'icon'      => 'fa fa-cubes',
                    'uri'       => '',
                    'parent_id' => 0,
                ],
                [
                    'id'        => 2,
                    'title'     => 'Scaffold',
                    'icon'      => '',
                    'uri'       => 'helpers/scaffold-modules',
                    'parent_id' => 1,
                ]
            ], 20);
        }
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function translate($text)
    {
        $trans = parent::translate($text);
        if(strcmp($trans, $text) === 0){
            $titleTranslation = 'dcat::menu.titles.'.trim(str_replace(' ', '_', strtolower($text)));
            if (Lang::has($titleTranslation)) {
                return __($titleTranslation);
            }
        }
        return $trans;
    }

}
