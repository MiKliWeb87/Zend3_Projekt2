<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserModel\Permissions\Role;

use Zend\Permissions\Acl\Role\GenericRole;

/**
 * Class GuestRole
 *
 * @package UserModel\Permissions\Role
 */
class GuestRole extends GenericRole
{
    /**
     * @var string name of role
     */
    const NAME = 'guest';

    /**
     * GuestRole constructor.
     */
    public function __construct()
    {
        parent::__construct( self::NAME);
    }
}
