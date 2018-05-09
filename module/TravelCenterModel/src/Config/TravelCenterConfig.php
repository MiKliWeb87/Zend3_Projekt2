<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\Config;

use Zend\Config\Config;

/**
 * Class TravelCenterConfig
 *
 * @package TravelCenterModel\Config
 */
class TravelCenterConfig extends Config implements TravelCenterConfigInterface
{
    /**
     * Get the status options
     */
    public function getStatusOptions()
    {
        return $this->get('status_options')->toArray();
    }
}
