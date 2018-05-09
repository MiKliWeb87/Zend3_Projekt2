<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertBackend\Permissions\Resource;

use Zend\Permissions\Acl\Resource\GenericResource;

/**
 * Class DisplayResource
 *
 * @package AdvertBackend\Permissions\Resource
 */
class DisplayResource extends GenericResource
{
    /**
     * @const name of resource
     */
    const NAME = 'advert-backend-display';

    /**
     * @const names of privileges
     */
    const PRIVILEGE_INDEX = 'index';
    const PRIVILEGE_SHOW  = 'show';

    /**
     * DisplayResource constructor.
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
    }
}
