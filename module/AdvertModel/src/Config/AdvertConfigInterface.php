<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertModel\Config;

/**
 * Interface AdvertConfigInterface
 *
 * @package AdvertModel\Config
 */
interface AdvertConfigInterface
{
    /**
     * Get the status options
     */
    public function getStatusOptions();

    /**
     * Get the type options
     */
    public function getTypeOptions();
}