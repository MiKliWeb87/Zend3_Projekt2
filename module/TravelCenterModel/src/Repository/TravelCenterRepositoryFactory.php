<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
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
