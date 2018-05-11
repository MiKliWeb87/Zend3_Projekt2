<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Authorization;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

/**
 * Interface AuthorizationListenerInterface
 *
 * @package UserFrontend\Authorization
 */
interface AuthorizationListenerInterface extends ListenerAggregateInterface
{
    /**
     * Authorize user
     *
     * @param MvcEvent $e
     */
    public function authorize(MvcEvent $e);

    /**
     * Prepare navigation
     *
     * @param MvcEvent $e
     */
    public function prepareNavigation(MvcEvent $e);
}
