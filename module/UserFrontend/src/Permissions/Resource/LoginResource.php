<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Permissions\Resource;

use Zend\Permissions\Acl\Resource\GenericResource;

/**
 * Class LoginResource
 *
 * @package UserFrontend\Permissions\Resource
 */
class LoginResource extends GenericResource
{
    /**
     * @const name of resource
     */
    const NAME = 'user-frontend-login';

    /**
     * @const names of privileges
     */
    const PRIVILEGE_INDEX = 'index';

    /**
     * LoginResource constructor.
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
    }
}
