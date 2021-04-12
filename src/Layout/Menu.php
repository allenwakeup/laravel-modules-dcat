<?php

namespace Goodcatch\Modules\Dcat\Layout;

use Dcat\Admin\Layout\Menu as Layout;
use Lang;

class Menu extends Layout
{

    /**
     * @var array
     */
    public static $goodcatchHelperNodes = [
        [
            'id'        => 1,
            'title'     => 'Modules Helpers',
            'icon'      => 'fa fa-cubes',
            'uri'       => '',
            'parent_id' => 0,
        ], [
            'id'        => 2,
            'title'     => 'Scaffold',
            'icon'      => '',
            'uri'       => 'goodcatch/laravel-modules/scaffold',
            'parent_id' => 1,
        ]
    ];

    /**
     * @var array
     */
    public static $goodcatchNodes = [
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
    ];


    /**
     * Register menu.
     */
    public function register()
    {
        parent::register();

        $this->add(self::$goodcatchNodes, 20);

        if (config('app.debug') && config('admin.helpers.enable', true)) {
            $this->add(self::$goodcatchHelperNodes, 20);
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
