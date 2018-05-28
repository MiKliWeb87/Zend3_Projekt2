<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Form;

use Interop\Container\ContainerInterface;
use UserModel\Hydrator\UserHydrator;
use UserModel\InputFilter\UserInputFilter;
use Zend\Hydrator\HydratorPluginManager;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

/**
 * Class UserFormAbstractFactory
 *
 * @package UserFrontend\Form
 */
class UserFormAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     *
     * @return mixed
     */
    public function canCreate(
        ContainerInterface $container, $requestedName
    ) {
        if (!class_exists($requestedName)) {
            return false;
        }

        return (is_subclass_of($requestedName, AbstractUserForm::class));
    }

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

        /** @var UserHydrator $userHydrator */
        $userHydrator = $hydratorManager->get(UserHydrator::class);

        /** @var InputFilterInterface $userInputFilter */
        $userInputFilter = $inputFilterManager->get(
            UserInputFilter::class
        );

        /** @var AbstractUserForm $form */
        $form = new $requestedName();
        $form->setHydrator($userHydrator);
        $form->setInputFilter($userInputFilter);

        return $form;
    }
}
