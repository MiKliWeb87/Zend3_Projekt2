<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2 
 */

namespace UserModel\Permissions\Role;

use Zend\Permissions\Acl\Role\GenericRole;

/**
 * Class TravelCenterRole
 *
 * @package UserModel\Permissions\Role
 */
class TravelCenterRole extends GenericRole
{
    /**
     * @var string name of role
     */
    const NAME = 'travelcenter';

    /**
     * TravelCenterRole constructor.
     */
    public function __construct()
    {
        parent::__construct( self::NAME);
    }
}