<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\Hydrator;

use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Strategy\DateTimeFormatterStrategy;

/**
 * Class TravelCenterHydrator
 *
 * @package TravelCenterModel\Hydrator
 */
class TravelCenterHydrator extends ClassMethods implements HydratorInterface
{
    /**
     * TravelCenterHydrator constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->addStrategy(
            'registered',
            new DateTimeFormatterStrategy('Y-m-d H:i:s')
        );
        $this->addStrategy(
            'updated',
            new DateTimeFormatterStrategy('Y-m-d H:i:s')
        );
    }
}
