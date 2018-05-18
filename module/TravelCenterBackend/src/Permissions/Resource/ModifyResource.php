<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2 
 */

namespace TravelCenterBackend\Permissions\Resource;

use Zend\Permissions\Acl\Resource\GenericResource;

/**
 * Class ModifyResource
 *
 * @package TravelCenterBackend\Permissions\Resource
 */
class ModifyResource extends GenericResource
{
    /**
     * @const name of resource
     */
    const NAME = 'travel-center-backend-modify'; //War warum auch immer ein Problem mit travelcenter-backend

    /**
     * @const names of privileges
     */
    const PRIVILEGE_ADD     = 'add';
    const PRIVILEGE_EDIT    = 'edit';
    const PRIVILEGE_DELETE  = 'delete';
    const PRIVILEGE_APPROVE = 'approve';
    const PRIVILEGE_BLOCK   = 'block';

    /**
     * ModifyResource constructor.
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
    }
}