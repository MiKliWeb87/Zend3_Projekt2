<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterBackend\Form;

use HolidaycenterModel\Config\HolidaycenterConfigInterface;
use HolidaycenterModel\Hydrator\HolidaycenterHydrator;
use HolidaycenterModel\InputFilter\HolidaycenterInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\HydratorPluginManager;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HolidaycenterFormFactory
 *
 * @package HolidaycenterBackend\Form
 */
class HolidaycenterFormFactory implements FactoryInterface
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

        /** @var HolidaycenterHydrator $holidaycenterHydrator */
        $holidaycenterHydrator = $hydratorManager->get(HolidaycenterHydrator::class);

        /** @var InputFilterInterface $holidaycenterInputFilter */
        $holidaycenterInputFilter = $inputFilterManager->get(
            HolidaycenterInputFilter::class
        );

        /** @var HolidaycenterConfigInterface $holidaycenterConfig */
        $holidaycenterConfig = $container->get(HolidaycenterConfigInterface::class);

        /** @var array $config */
        $moduleConfig = $container->get('Config');

        $form = new HolidaycenterForm();
        $form->setHydrator($holidaycenterHydrator);
        $form->setInputFilter($holidaycenterInputFilter);
        $form->setStatusOptions($holidaycenterConfig->getStatusOptions());
        $form->setLogoFilePath(
            $moduleConfig['holidaycenter_admin']['logo_file_path']
        );
        $form->setLogoFilePattern(
            $moduleConfig['holidaycenter_admin']['logo_file_pattern']
        );

        return $form;
    }
}
