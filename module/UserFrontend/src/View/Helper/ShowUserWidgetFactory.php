<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ShowUserWidgetFactory
 *
 * @package UserFrontend\View\Helper
 */
class ShowUserWidgetFactory implements FactoryInterface
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
        /** @var AuthenticationService $authService */
        $authService = $container->get(AuthenticationService::class);

        if ($authService->hasIdentity()) {
            $identity = $authService->getIdentity();
        } else {
            $identity = null;
        }

        $viewHelper = new ShowUserWidget();
        $viewHelper->setIdentity($identity);

        return $viewHelper;
    }
}
