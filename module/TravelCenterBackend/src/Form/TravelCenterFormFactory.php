<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterBackend\Form;

use TravelCenterModel\Config\TravelCenterConfigInterface;
use TravelCenterModel\Hydrator\TravelCenterHydrator;
use TravelCenterModel\InputFilter\TravelCenterInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\HydratorPluginManager;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class TravelCenterFormFactory
 *
 * @package TravelCenterBackend\Form
 */
class TravelCenterFormFactory implements FactoryInterface
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
        /** @var HydratorPluginManager $hydratorManager */
        $hydratorManager = $container->get('HydratorManager');

        /** @var InputFilterPluginManager $inputFilterManager */
        $inputFilterManager = $container->get('InputFilterManager');

        /** @var TravelCenterHydrator $travelcenterHydrator */
        $travelcenterHydrator = $hydratorManager->get(TravelCenterHydrator::class);

        /** @var InputFilterInterface $travelcenterInputFilter */
        $travelcenterInputFilter = $inputFilterManager->get(
            TravelCenterInputFilter::class
        );

        /** @var TravelCenterConfigInterface $travelcenterConfig */
        $travelcenterConfig = $container->get(TravelCenterConfigInterface::class);

        /** @var array $config */
        $moduleConfig = $container->get('Config');

        $form = new TravelCenterForm();
        $form->setHydrator($travelcenterHydrator);
        $form->setInputFilter($travelcenterInputFilter);
        $form->setStatusOptions($travelcenterConfig->getStatusOptions());
        $form->setLogoFilePath(
            $moduleConfig['travelcenter_admin']['logo_file_path']
        );
        $form->setLogoFilePattern(
            $moduleConfig['travelcenter_admin']['logo_file_pattern']
        );

        return $form;
    }
}
