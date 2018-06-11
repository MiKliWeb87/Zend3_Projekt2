<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use HolidaycenterModel\Config\HolidaycenterConfigFactory;
use HolidaycenterModel\Config\HolidaycenterConfigInterface;
use HolidaycenterModel\Hydrator\HolidaycenterHydrator;
use HolidaycenterModel\InputFilter\HolidaycenterInputFilter;
use HolidaycenterModel\InputFilter\HolidaycenterInputFilterFactory;
use HolidaycenterModel\Repository\HolidaycenterRepositoryFactory;
use HolidaycenterModel\Repository\HolidaycenterRepositoryInterface;
use HolidaycenterModel\Storage\Db\HolidaycenterDbStorage;
use HolidaycenterModel\Storage\Db\HolidaycenterDbStorageFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            HolidaycenterConfigInterface::class => HolidaycenterConfigFactory::class,

            HolidaycenterDbStorage::class => HolidaycenterDbStorageFactory::class,

            HolidaycenterRepositoryInterface::class =>
                HolidaycenterRepositoryFactory::class
        ],
    ],

    'hydrators' => [
        'factories' => [
            HolidaycenterHydrator::class => InvokableFactory::class,
        ],
    ],

    'input_filters' => [
        'factories' => [
            HolidaycenterInputFilter::class => HolidaycenterInputFilterFactory::class,
        ],
    ],

    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => HOLIDAYCENTER_MODEL_MODULE_ROOT . '/language',
                'pattern'  => '%s.php',
            ],
        ],
    ],
];
