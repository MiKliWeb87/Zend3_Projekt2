<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterModel\Config;

/**
 * Interface HolidaycenterConfigInterface
 *
 * @package HolidaycenterModel\Config
 */
interface HolidaycenterConfigInterface
{
    /**
     * Get the status options
     */
    public function getStatusOptions();
}
