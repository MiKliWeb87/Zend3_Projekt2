<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2 
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