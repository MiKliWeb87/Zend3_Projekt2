<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use HolidaycenterBackend\Controller\DisplayController;
use HolidaycenterBackend\Controller\DisplayControllerFactory;
use HolidaycenterBackend\Controller\ModifyController;
use HolidaycenterBackend\Controller\ModifyControllerFactory;
use HolidaycenterBackend\Form\HolidaycenterForm;
use HolidaycenterBackend\Form\HolidaycenterFormFactory;
use HolidaycenterBackend\Permissions\Resource\DisplayResource;
use HolidaycenterBackend\Permissions\Resource\ModifyResource;
use UserModel\Permissions\Role\AdminRole;
use UserModel\Permissions\Role\GuestRole;
use Zend\Navigation\Page\Mvc;
use Zend\Permissions\Acl\Acl;
use Zend\Router\Http\Segment;

return [
    'holidaycenter_admin' => [
        'logo_file_path'    => PROJECT_ROOT . '/public',
        'logo_file_pattern' => '/logos/%s.png',
    ],

    'router'        => [
        'routes' => [
            'holidaycenter-backend' => [
                'type'          => Segment::class,
                'options'       => [
                    'route'       => '/:lang/holidaycenter-backend',
                    'defaults'    => [
                        'controller' => DisplayController::class,
                        'action'     => 'index',
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
                                'action' => '(add|edit|delete|approve|block)',
                                'id'     => '[1-9][0-9]*',
                            ],
                        ],
                    ],
                    'show'   => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/show[/:id]',
                            'defaults'    => [
                                'action' => 'show',
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

    'controllers'   => [
        'factories' => [
            DisplayController::class => DisplayControllerFactory::class,
            ModifyController::class  => ModifyControllerFactory::class,
        ],
    ],

    'view_manager'  => [
        'template_map'        =>
            include HOLIDAYCENTER_BACKEND_MODULE_ROOT . '/config/template_map.config.php',
        'template_path_stack' => [
            HOLIDAYCENTER_BACKEND_MODULE_ROOT . '/view'
        ],
    ],

    'form_elements' => [
        'factories' => [
            HolidaycenterForm::class => HolidaycenterFormFactory::class,
        ],
    ],

    'navigation'    => [
        'default' => [
            'holidaycenter-backend' => [
                'type'          => Mvc::class,
                'order'         => '950',
                'label'         => 'holidaycenter_backend_navigation_admin',
                'route'         => 'holidaycenter-backend',
                'controller'    => DisplayController::class,
                'action'        => 'index',
                'useRouteMatch' => true,
                'resource'      => DisplayResource::NAME,
                'privilege'     => DisplayResource::PRIVILEGE_INDEX,
                'pages'         => [
                    'edit' => [
                        'type'    => Mvc::class,
                        'route'   => 'holidaycenter-backend/modify',
                        'visible' => false,
                    ],
                    'show' => [
                        'type'    => Mvc::class,
                        'route'   => 'holidaycenter-backend/show',
                        'visible' => false,
                    ],
                    'page' => [
                        'type'    => Mvc::class,
                        'route'   => 'holidaycenter-backend/page',
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
                'base_dir' => HOLIDAYCENTER_BACKEND_MODULE_ROOT . '/language',
                'pattern'  => '%s.php',
            ],
        ],
    ],

    'acl' => [
        AdminRole::NAME   => [
            DisplayResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
            ModifyResource::NAME => [
                Acl::TYPE_ALLOW => null,
            ],
        ],
    ],
];
