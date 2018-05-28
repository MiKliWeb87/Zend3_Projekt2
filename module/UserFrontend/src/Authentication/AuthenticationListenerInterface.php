<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Authentication;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class AuthenticationListener
 *
 * @package UserFrontend\Authentication
 */
interface AuthenticationListenerInterface
    extends ListenerAggregateInterface
{
    /**
     * Authenticate user
     *
     * @param MvcEvent $e
     */
    public function authenticate(MvcEvent $e);
}
