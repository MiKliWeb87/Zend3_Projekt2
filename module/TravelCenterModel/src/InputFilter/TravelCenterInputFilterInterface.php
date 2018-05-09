<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
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
