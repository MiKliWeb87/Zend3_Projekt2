<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use TravelCenterModel\Config\TravelCenterConfigFactory;
use TravelCenterModel\Config\TravelCenterConfigInterface;
use TravelCenterModel\Hydrator\TravelCenterHydrator;
use TravelCenterModel\InputFilter\TravelCenterInputFilter;
use TravelCenterModel\InputFilter\TravelCenterInputFilterFactory;
use TravelCenterModel\Repository\TravelCenterRepositoryFactory;
use TravelCenterModel\Repository\TravelCenterRepositoryInterface;
use TravelCenterModel\Storage\Db\TravelCenterDbStorage;
use TravelCenterModel\Storage\Db\TravelCenterDbStorageFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            TravelCenterConfigInterface::class => TravelCenterConfigFactory::class,

            TravelCenterDbStorage::class => TravelCenterDbStorageFactory::class,

            TravelCenterRepositoryInterface::class =>
                TravelCenterRepositoryFactory::class
        ],
    ],

    'hydrators' => [
        'factories' => [
            TravelCenterHydrator::class => InvokableFactory::class,
        ],
    ],

    'input_filters' => [
        'factories' => [
            TravelCenterInputFilter::class => TravelCenterInputFilterFactory::class,
        ],
    ],

    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => TRAVELCENTER_MODEL_MODULE_ROOT . '/language',
                'pattern'  => '%s.php',
            ],
        ],
    ],
];
