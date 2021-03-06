<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'modules'                 => [
        'Zend\Mvc\Plugin\Identity',
        'TravelloFilter',
        'TravelloViewHelper',
        'Zend\Mvc\I18n',
        'Zend\Mvc\Plugin\FlashMessenger',
        'Zend\I18n',
        'Zend\Form',
        'Zend\InputFilter',
        'Zend\Db',
        'Zend\Filter',
        'Zend\Hydrator',
        'Zend\Paginator',
        'Zend\Navigation',
        'Zend\Session',
        'Zend\Router',
        'Zend\Validator',
        'UserFrontend',
        'UserBackend',
        'UserModel',
       // 'CompanyBackend',
       // 'CompanyModel',
		'HolidaycenterBackend',
		'HolidaycenterModel',
        'AdvertFrontend',
        'AdvertBackend',
        'AdvertModel',
        'Application',
    ],
    'module_listener_options' => [
        'module_paths'             => [
            PROJECT_ROOT . '/module',
            PROJECT_ROOT . '/vendor',
        ],
        'cache_dir'                => PROJECT_ROOT . '/data/cache',
        'config_cache_enabled'     => true,
        'config_cache_key'         => 'application.config.cache',
        'module_map_cache_enabled' => true,
        'module_map_cache_key'     => 'application.module.cache',
    ],
];
