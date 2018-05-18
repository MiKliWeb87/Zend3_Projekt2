<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2 
 */

namespace TravelCenterModel\Repository;

use TravelCenterModel\Storage\Db\TravelCenterDbStorage;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class TravelCenterRepositoryFactory
 *
 * @package TravelCenterModel\Repository
 */
class TravelCenterRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(
        ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        $travelcenterDbStorage = $container->get(TravelCenterDbStorage::class);

        return new TravelCenterRepository($travelcenterDbStorage);
    }
}