<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\InputFilter;

use TravelCenterModel\Config\TravelCenterConfigInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class TravelCenterInputFilterFactory
 *
 * @package TravelCenterModel\InputFilter
 */
class TravelCenterInputFilterFactory implements FactoryInterface
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
        /** @var TravelCenterConfigInterface $travelcenterConfig */
        $travelcenterConfig = $container->get(TravelCenterConfigInterface::class);

        $inputFilter = new TravelCenterInputFilter();
        $inputFilter->setStatusOptions(
            array_keys($travelcenterConfig->getStatusOptions())
        );

        return $inputFilter;
    }
}