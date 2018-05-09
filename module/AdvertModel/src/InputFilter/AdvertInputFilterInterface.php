<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertModel\InputFilter;

/**
 * Interface AdvertInputFilterInterface
 *
 * @package AdvertModel\InputFilter
 */
interface AdvertInputFilterInterface
{
    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions);

    /**
     * @param array $typeOptions
     */
    public function setTypeOptions($typeOptions);

    /**
     * @param array $travelcenterOptions
     */
    public function setTravelCenterOptions($travelcenterOptions);

    /**
     * Init input filter
     */
    public function init();
}