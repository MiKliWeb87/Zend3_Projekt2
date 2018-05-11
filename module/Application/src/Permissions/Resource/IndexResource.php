<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Permissions\Resource;

use Zend\Permissions\Acl\Resource\GenericResource;

/**
 * Class IndexResource
 *
 * @package Application\Permissions\Resource
 */
class IndexResource extends GenericResource
{
    /**
     * @var string name of resource
     */
    const NAME = 'application-index';

    /**
     * @var string name of privileges
     */
    const PRIVILEGE_INDEX = 'index';

    /**
     * IndexResource constructor.
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
    }
}
