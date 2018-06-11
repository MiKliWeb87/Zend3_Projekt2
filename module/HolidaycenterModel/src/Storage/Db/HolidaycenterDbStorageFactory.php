<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterModel\Storage\Db;

use HolidaycenterModel\Entity\HolidaycenterEntity;
use HolidaycenterModel\Hydrator\HolidaycenterHydrator;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HolidaycenterDbStorageFactory
 *
 * @package HolidaycenterModel\Storage\Db
 */
class HolidaycenterDbStorageFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        /** @var AdapterInterface $dbAdapter */
        $dbAdapter = $container->get(Adapter::class);

        $resultSetPrototype = new HydratingResultSet(
            new HolidaycenterHydrator(),
            new HolidaycenterEntity()
        );

        $tableGateway = new TableGateway(
            'holidaycenter', $dbAdapter, null, $resultSetPrototype
        );

        $storage = new HolidaycenterDbStorage($tableGateway);

        return $storage;
    }
}
