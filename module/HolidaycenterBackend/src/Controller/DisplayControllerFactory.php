<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2 
 */

namespace HolidaycenterBackend\Controller;

use HolidaycenterModel\Repository\HolidaycenterRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DisplayControllerFactory
 *
 * @package HolidaycenterBackend\Controller
 */
class DisplayControllerFactory implements FactoryInterface
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
        $holidaycenterRepository = $container->get(
            HolidaycenterRepositoryInterface::class
        );

        $controller = new DisplayController();
        $controller->setHolidaycenterRepository($holidaycenterRepository);

        return $controller;
    }
}