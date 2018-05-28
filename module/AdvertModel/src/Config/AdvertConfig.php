<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertModel\Config;

use Zend\Config\Config;

/**
 * Class AdvertConfig
 *
 * @package AdvertModel\Config
 */
class AdvertConfig extends Config implements AdvertConfigInterface
{
    /**
     * Get the status options
     */
    public function getStatusOptions()
    {
        return $this->get('status_options')->toArray();
    }

    /**
     * Get the type options
     */
    public function getTypeOptions()
    {
        return $this->get('type_options')->toArray();
    }
}
