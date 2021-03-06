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
 * Class ForbiddenResource
 *
 * @package UserFrontend\Permissions\Resource
 */
class ForbiddenResource extends GenericResource
{
    /**
     * @const name of resource
     */
    const NAME = 'user-frontend-forbidden';

    /**
     * @const names of privileges
     */
    const PRIVILEGE_INDEX = 'index';

    /**
     * ForbiddenResource constructor.
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
    }
}
