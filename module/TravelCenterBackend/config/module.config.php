<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton   Ralf Eggert <ralf@travello.de>  * @author			 Mirco Klink
 * @linkSkeleton     https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use TravelCenterBackend\Controller\DisplayController;
use TravelCenterBackend\Controller\DisplayControllerFactory;
use TravelCenterBackend\Controller\ModifyController;
use TravelCenterBackend\Controller\ModifyControllerFactory;
use TravelCenterBackend\Form\TravelCenterForm;
use TravelCenterBackend\Form\TravelCenterFormFactory;
use TravelCenterBackend\Permissions\Resource\DisplayResource;
use TravelCenterBackend\Permissions\Resource\ModifyResource;
use UserModel\Permissions\Role\AdminRole;
use UserModel\Permissions\Role\GuestRole;
use Zend\Navigation\Page\Mvc;
use Zend\Permissions\Acl\Acl;
use Zend\Router\Http\Segment;

return [
    'travelcenter_admin' => [
        'logo_file_path'    => PROJECT_ROOT . '/public',
        'logo_file_pattern' => '/logos/%s.png',
    ],

    'router'        => [
        'routes' => [
            'travelcenter-backend' => [
                'type'          => Segment::class,
                'options'       => [
                    'route'       => '/:lang/travelcenter-backend',
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
            include TRAVELCENTER_BACKEND_MODULE_ROOT . '/config/template_map.config.php',
        'template_path_stack' => [
            TRAVELCENTER_BACKEND_MODULE_ROOT . '/view'
        ],
    ],

    'form_elements' => [
        'factories' => [
            TravelCenterForm::class => TravelCenterFormFactory::class,
        ],
    ],

    'navigation'    => [
        'default' => [
            'travelcenter-backend' => [
                'type'          => Mvc::class,
                'order'         => '950',
                'label'         => 'travelcenter_backend_navigation_admin',
                'route'         => 'travelcenter-backend',
                'controller'    => DisplayController::class,
                'action'        => 'index',
                'useRouteMatch' => true,
                'resource'      => DisplayResource::NAME,
                'privilege'     => DisplayResource::PRIVILEGE_INDEX,
                'pages'         => [
                    'edit' => [
                        'type'    => Mvc::class,
                        'route'   => 'travelcenter-backend/modify',
                        'visible' => false,
                    ],
                    'show' => [
                        'type'    => Mvc::class,
                        'route'   => 'travelcenter-backend/show',
                        'visible' => false,
                    ],
                    'page' => [
                        'type'    => Mvc::class,
                        'route'   => 'travelcenter-backend/page',
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
                'base_dir' => TRAVELCENTER_BACKEND_MODULE_ROOT . '/language',
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
