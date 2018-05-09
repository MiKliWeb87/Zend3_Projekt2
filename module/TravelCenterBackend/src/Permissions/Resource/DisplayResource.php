<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton   Ralf Eggert <ralf@travello.de>  * @author	   		 Mirco Klink 
 * @linkSkeleton     https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterBackend\Permissions\Resource;

use Zend\Permissions\Acl\Resource\GenericResource;

/**
 * Class DisplayResource
 *
 * @package TravelCenterBackend\Permissions\Resource
 */
class DisplayResource extends GenericResource
{
    /**
     * @const name of resource
     */
    const NAME = 'travel-center-backend-display'; //ändere ich hier travel-center kommt DB Fehler

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
