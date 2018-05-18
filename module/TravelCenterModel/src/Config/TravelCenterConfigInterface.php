<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2 
 */

namespace TravelCenterModel\Config;

/**
 * Interface TravelCenterConfigInterface
 *
 * @package TravelCenterModel\Config
 */
interface TravelCenterConfigInterface
{
    /**
     * Get the status options
     */
    public function getStatusOptions();
}