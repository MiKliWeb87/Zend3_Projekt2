<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Controller;

use Interop\Container\ContainerInterface;
use UserFrontend\Form\UserRegisterForm;
use UserFrontend\Form\UserRegisterFormInterface;
use UserModel\Repository\UserRepositoryInterface;
use Zend\Form\FormElementManager\FormElementManagerV3Polyfill;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class RegisterControllerFactory
 *
 * @package UserFrontend\Controller
 */
class RegisterControllerFactory implements FactoryInterface
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
        /** @var FormElementManagerV3Polyfill $formElementManager */
        $formElementManager = $container->get('FormElementManager');

        /** @var UserRepositoryInterface $userRepository */
        $userRepository = $container->get(
            UserRepositoryInterface::class
        );

        /** @var UserRegisterFormInterface $userForm */
        $userForm = $formElementManager->get(UserRegisterForm::class);

        $controller = new RegisterController();
        $controller->setUserRepository($userRepository);
        $controller->setUserForm($userForm);

        return $controller;
    }
}
