<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2 
 */
namespace TravelCenterModel\InputFilter;

/**
 * Interface TravelCenterInputFilterInterface
 *
 * @package TravelCenterModel\InputFilter
 */
interface TravelCenterInputFilterInterface
{
    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions);

    /**
     * Init input filter
     */
    public function init();
}