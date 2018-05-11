<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use UserModel\Config\UserConfigFactory;
use UserModel\Config\UserConfigInterface;
use UserModel\Hydrator\UserHydrator;
use UserModel\InputFilter\UserInputFilter;
use UserModel\InputFilter\UserInputFilterFactory;
use UserModel\Permissions\UserAcl;
use UserModel\Permissions\UserAclFactory;
use UserModel\Repository\UserRepositoryFactory;
use UserModel\Repository\UserRepositoryInterface;
use UserModel\Storage\Db\UserDbStorage;
use UserModel\Storage\Db\UserDbStorageFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            UserConfigInterface::class => UserConfigFactory::class,

            UserDbStorage::class => UserDbStorageFactory::class,

            UserRepositoryInterface::class =>
                UserRepositoryFactory::class,

            UserAcl::class => UserAclFactory::class,
        ],
    ],

    'hydrators' => [
        'factories' => [
            UserHydrator::class => InvokableFactory::class,
        ],
    ],

    'input_filters' => [
        'factories' => [
            UserInputFilter::class => UserInputFilterFactory::class,
        ],
    ],

    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => USER_MODEL_MODULE_ROOT . '/language',
                'pattern'  => '%s.php',
            ],
        ],
    ],
];
