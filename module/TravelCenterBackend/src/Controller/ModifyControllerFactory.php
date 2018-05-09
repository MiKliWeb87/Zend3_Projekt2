<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterBackend\Controller;

use TravelCenterBackend\Form\TravelCenterForm;
use TravelCenterBackend\Form\TravelCenterFormInterface;
use TravelCenterModel\Repository\TravelCenterRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Form\FormElementManager\FormElementManagerTrait;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ModifyControllerFactory
 *
 * @package TravelCenterBackend\Controller
 */
class ModifyControllerFactory implements FactoryInterface
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
        /** @var FormElementManagerTrait $formElementManager */
        $formElementManager = $container->get('FormElementManager');

        $travelcenterRepository = $container->get(
            TravelCenterRepositoryInterface::class
        );

        /** @var TravelCenterFormInterface $travelcenterForm */
        $travelcenterForm = $formElementManager->get(TravelCenterForm::class);

        $controller = new ModifyController();
        $controller->setTravelCenterRepository($travelcenterRepository);
        $controller->setTravelCenterForm($travelcenterForm);

        return $controller;
    }
}
