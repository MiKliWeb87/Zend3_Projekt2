<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterModel\Config;

use Zend\Config\Config;

/**
 * Class HolidaycenterConfig
 *
 * @package HolidaycenterModel\Config
 */
class HolidaycenterConfig extends Config implements HolidaycenterConfigInterface
{
    /**
     * Get the status options
     */
    public function getStatusOptions()
    {
        return $this->get('status_options')->toArray();
    }
}
