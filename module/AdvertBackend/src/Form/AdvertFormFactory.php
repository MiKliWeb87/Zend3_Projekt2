<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertBackend\Form;

use AdvertModel\Config\AdvertConfigInterface;
use AdvertModel\Hydrator\AdvertHydrator;
use AdvertModel\InputFilter\AdvertInputFilter;
use HolidaycenterModel\Repository\HolidaycenterRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\HydratorPluginManager;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AdvertFormFactory
 *
 * @package AdvertBackend\Form
 */
class AdvertFormFactory implements FactoryInterface
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
        /** @var HydratorPluginManager $hydratorManager */
        $hydratorManager = $container->get('HydratorManager');

        /** @var InputFilterPluginManager $inputFilterManager */
        $inputFilterManager = $container->get('InputFilterManager');

        /** @var AdvertHydrator $advertHydrator */
        $advertHydrator = $hydratorManager->get(AdvertHydrator::class);

        /** @var InputFilterInterface $advertInputFilter */
        $advertInputFilter = $inputFilterManager->get(
            AdvertInputFilter::class
        );

        /** @var AdvertConfigInterface $advertConfig */
        $advertConfig = $container->get(AdvertConfigInterface::class);

        /** @var HolidaycenterRepositoryInterface $holidaycenterRepository */
        $holidaycenterRepository = $container->get(
            HolidaycenterRepositoryInterface::class
        );

        $form = new AdvertForm();
        $form->setHydrator($advertHydrator);
        $form->setInputFilter($advertInputFilter);
        $form->setStatusOptions($advertConfig->getStatusOptions());
        $form->setTypeOptions($advertConfig->getTypeOptions());
        $form->setHolidaycenterOptions($holidaycenterRepository->getHolidaycenterOptions());

        return $form;
    }
}
