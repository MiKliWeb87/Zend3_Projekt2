<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertModel\Hydrator;

use HolidaycenterModel\Hydrator\HolidaycenterHydrator;
use HolidaycenterModel\Hydrator\Strategy\HolidaycenterEntityStrategy;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Strategy\DateTimeFormatterStrategy;

/**
 * Class AdvertHydrator
 *
 * @package AdvertModel\Hydrator
 */
class AdvertHydrator extends ClassMethods implements HydratorInterface
{
    /**
     * HolidaycenterHydrator constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->addStrategy(
            'created',
            new DateTimeFormatterStrategy('Y-m-d H:i:s')
        );
        $this->addStrategy(
            'updated',
            new DateTimeFormatterStrategy('Y-m-d H:i:s')
        );
        $this->addStrategy(
            'holidaycenter',
            new HolidaycenterEntityStrategy(new HolidaycenterHydrator())
        );
    }
}
