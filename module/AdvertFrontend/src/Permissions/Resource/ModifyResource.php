<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertFrontend\Permissions\Resource;

use Zend\Permissions\Acl\Resource\GenericResource;

/**
 * Class ModifyResource
 *
 * @package AdvertFrontend\Permissions\Resource
 */
class ModifyResource extends GenericResource
{
    /**
     * @const name of resource
     */
    const NAME = 'advert-frontend-modify';

    /**
     * @const names of privileges
     */
    const PRIVILEGE_ADD    = 'add';
    const PRIVILEGE_EDIT   = 'edit';
    const PRIVILEGE_DELETE = 'delete';

    /**
     * ModifyResource constructor.
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
    }
}
