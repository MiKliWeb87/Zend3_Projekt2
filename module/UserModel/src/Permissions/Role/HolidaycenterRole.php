<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserModel\Permissions\Role;

use Zend\Permissions\Acl\Role\GenericRole;

/**
 * Class HolidaycenterRole
 *
 * @package UserModel\Permissions\Role
 */
class HolidaycenterRole extends GenericRole
{
    /**
     * @var string name of role
     */
    const NAME = 'holidaycenter';

    /**
     * HolidaycenterRole constructor.
     */
    public function __construct()
    {
        parent::__construct( self::NAME);
    }
}
