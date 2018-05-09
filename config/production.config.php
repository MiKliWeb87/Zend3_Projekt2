<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'modules' => [
    ],

    'module_listener_options' => [
        'config_glob_paths' => [
            PROJECT_ROOT
            . '/config/autoload/{,*.}{global,production,local}.php',
        ],
    ],
];
