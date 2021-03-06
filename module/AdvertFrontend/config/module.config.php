<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use AdvertFrontend\Controller\DisplayController;
use AdvertFrontend\Controller\DisplayControllerFactory;
use AdvertFrontend\Controller\ModifyController;
use AdvertFrontend\Controller\ModifyControllerFactory;
use AdvertFrontend\Permissions\Resource\DisplayResource;
use AdvertFrontend\Permissions\Resource\ModifyResource;
use UserModel\Permissions\Role\AdminRole;
//use UserModel\Permissions\Role\CompanyRole;
use UserModel\Permissions\Role\HolidaycenterRole;
use UserModel\Permissions\Role\GuestRole;
use Zend\Navigation\Page\Mvc;
use Zend\Permissions\Acl\Acl;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'advert-holiday'     => [
                'type'          => Segment::class,
                'options'       => [
                    'route'       => '/:lang/holiday',
                    'defaults'    => [
                        'controller' => DisplayController::class,
                        'action'     => 'index',
                        'type'       => 'holiday',
                        'lang'       => 'de',
                    ],
                    'constraints' => [
                        'lang' => '(de|en)',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'modify' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/:action[/:id]',
                            'defaults'    => [
                                'controller' => ModifyController::class,
                            ],
                            'constraints' => [
                                'action' => '(add|edit|delete)',
                                'id'     => '[1-9][0-9]*',
                            ],
                        ],
                    ],
                    'detail' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/detail[/:id]',
                            'defaults'    => [
                                'action' => 'detail',
                            ],
                            'constraints' => [
                                'id' => '[1-9][0-9]*',
                            ],
                        ],
                    ],
                    'page'   => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/:page',
                            'constraints' => [
                                'page' => '[1-9][0-9]*',
                            ],
                        ],
                    ],
                ],
            ],
            'advert-shortholiday' => [
                'type'          => Segment::class,
                'options'       => [
                    'route'       => '/:lang/shortholiday',
                    'defaults'    => [
                        'controller' => DisplayController::class,
                        'action'     => 'index',
                        'type'       => 'shortholiday',
                        'lang'       => 'de',
                    ],
                    'constraints' => [
                        'lang' => '(de|en)',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'modify' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/:action[/:id]',
                            'defaults'    => [
                                'controller' => ModifyController::class,
                            ],
                            'constraints' => [
                                'action' => '(add|edit|delete)',
                                'id'     => '[1-9][0-9]*',
                            ],
                        ],
                    ],
                    'detail' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/detail[/:id]',
                            'defaults'    => [
                                'action' => 'detail',
                            ],
                            'constraints' => [
                                'id' => '[1-9][0-9]*',
                            ],
                        ],
                    ],
                    'page'   => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/:page',
                            'constraints' => [
                                'page' => '[1-9][0-9]*',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            DisplayController::class => DisplayControllerFactory::class,
            ModifyController::class  => ModifyControllerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map'        =>
            include ADVERT_FRONTEND_MODULE_ROOT . '/config/template_map.config.php',
        'template_path_stack' => [
            ADVERT_FRONTEND_MODULE_ROOT . '/view'
        ],
    ],

    'navigation' => [
        'default' => [
            'holiday'     => [
                'type'          => Mvc::class,
                'order'         => '200',
                'label'         => 'advert_frontend_navigation_holidays',
                'route'         => 'advert-holiday',
                'controller'    => DisplayController::class,
                'action'        => 'index',
                'useRouteMatch' => true,
                'resource'      => DisplayResource::NAME,
                'privilege'     => DisplayResource::PRIVILEGE_INDEX,
                'pages'         => [
                    'edit' => [
                        'type'    => Mvc::class,
                        'route'   => 'advert-holiday/modify',
                        'visible' => false,
                    ],
                    'show' => [
                        'type'    => Mvc::class,
                        'route'   => 'advert-holiday/detail',
                        'visible' => false,
                    ],
                    'page' => [
                        'type'    => Mvc::class,
                        'route'   => 'advert-holiday/page',
                        'visible' => false,
                    ],
                ],
            ],
            'shortholiday' => [
                'type'          => Mvc::class,
                'order'         => '300',
                'label'         => 'advert_frontend_navigation_shortholidays',
                'route'         => 'advert-shortholiday',
                'controller'    => DisplayController::class,
                'action'        => 'index',
                'useRouteMatch' => true,
                'resource'      => DisplayResource::NAME,
                'privilege'     => DisplayResource::PRIVILEGE_INDEX,
                'pages'         => [
                    'edit' => [
                        'type'    => Mvc::class,
                        'route'   => 'advert-shortholiday/modify',
                        'visible' => false,
                    ],
                    'show' => [
                        'type'    => Mvc::class,
                        'route'   => 'advert-shortholiday/detail',
                        'visible' => false,
                    ],
                    'page' => [
                        'type'    => Mvc::class,
                        'route'   => 'advert-shortholiday/page',
                        'visible' => false,
                    ],
                ],
            ],
        ],
    ],

    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => ADVERT_FRONTEND_MODULE_ROOT . '/language',
                'pattern'  => '%s.php',
            ],
        ],
    ],
//Zugriffsrechte
    'acl' => [
        GuestRole::NAME   => [
            DisplayResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
        ],
    /*    CompanyRole::NAME => [
            DisplayResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
            ModifyResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
        ],*/
		HolidaycenterRole::NAME => [
            DisplayResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
            ModifyResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
        ],
        AdminRole::NAME   => [
            DisplayResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
        ],
    ],
];