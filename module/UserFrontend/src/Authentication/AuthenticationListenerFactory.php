<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Authentication;

use Interop\Container\ContainerInterface;
use UserFrontend\Form\UserLoginForm;
use UserFrontend\Form\UserLoginFormInterface;
use UserModel\Hydrator\UserHydrator;
use Zend\Authentication\AuthenticationService;
use Zend\Form\FormElementManager\FormElementManagerTrait;
use Zend\Hydrator\HydratorPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AuthenticationListenerFactory
 *
 * @package UserFrontend\Authentication
 */
class AuthenticationListenerFactory implements FactoryInterface
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
        /** @var FormElementManagerTrait $formElementManager */
        $formElementManager = $container->get('FormElementManager');

        /** @var HydratorPluginManager $hydratorManager */
        $hydratorManager = $container->get('HydratorManager');

        $authService = $container->get(AuthenticationService::class);

        /** @var UserLoginFormInterface $userLoginForm */
        $userLoginForm = $formElementManager->get(UserLoginForm::class);

        $userHydrator = $hydratorManager->get(UserHydrator::class);

        $authListener = new AuthenticationListener(
            $authService, $userLoginForm, $userHydrator
        );

        return $authListener;
    }
}
