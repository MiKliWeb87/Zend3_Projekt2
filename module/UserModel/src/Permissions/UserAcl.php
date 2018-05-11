<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserModel\Permissions;

use UserModel\Permissions\Role\AdminRole;
use UserModel\Permissions\Role\TravelCenterRole;
use UserModel\Permissions\Role\GuestRole;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Acl as ZendAcl;

/**
 * Class UserAcl
 *
 * @package UserModel\Permissions
 */
class UserAcl extends ZendAcl
{
    /**
     * Acl constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->addRole(new GuestRole());
        $this->addRole(new TravelCenterRole());
        $this->addRole(new AdminRole());

        $this->addConfig($config);
    }

    /**
     * @param array $config
     */
    private function addConfig(array $config)
    {
        foreach ($config as $roleName => $roleConfig) {
            foreach ($roleConfig as $resourceName => $resourceConfig) {
                if (!$this->hasResource($resourceName)) {
                    $this->addResource($resourceName);
                }

                foreach ($resourceConfig as $right => $privileges) {
                    switch ($right) {
                        case Acl::TYPE_ALLOW:
                            $this->allow(
                                $roleName, $resourceName, $privileges
                            );
                            break;

                        case Acl::TYPE_DENY:
                            $this->deny(
                                $roleName, $resourceName, $privileges
                            );
                            break;
                    }
                }
            }
        }
    }
}
