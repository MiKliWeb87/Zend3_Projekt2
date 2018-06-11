<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2 
 */

namespace HolidaycenterModel\InputFilter;

use HolidaycenterModel\Config\HolidaycenterConfigInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HolidaycenterInputFilterFactory
 *
 * @package HolidaycenterModel\InputFilter
 */
class HolidaycenterInputFilterFactory implements FactoryInterface
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
        /** @var HolidaycenterConfigInterface $holidaycenterConfig */
        $holidaycenterConfig = $container->get(HolidaycenterConfigInterface::class);

        $inputFilter = new HolidaycenterInputFilter();
        $inputFilter->setStatusOptions(
            array_keys($holidaycenterConfig->getStatusOptions())
        );

        return $inputFilter;
    }
}