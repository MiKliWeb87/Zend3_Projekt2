<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterBackend\Controller;

use HolidaycenterBackend\Form\HolidaycenterForm;
use HolidaycenterBackend\Form\HolidaycenterFormInterface;
use HolidaycenterModel\Repository\HolidaycenterRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Form\FormElementManager\FormElementManagerTrait;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ModifyControllerFactory
 *
 * @package HolidaycenterBackend\Controller
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

        $holidaycenterRepository = $container->get(
            HolidaycenterRepositoryInterface::class
        );

        /** @var HolidaycenterFormInterface $holidaycenterForm */
        $holidaycenterForm = $formElementManager->get(HolidaycenterForm::class);

        $controller = new ModifyController();
        $controller->setHolidaycenterRepository($holidaycenterRepository);
        $controller->setHolidaycenterForm($holidaycenterForm);

        return $controller;
    }
}
