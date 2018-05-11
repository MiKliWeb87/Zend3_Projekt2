<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\Hydrator\Strategy;

use TravelCenterModel\Entity\TravelCenterEntity;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class TravelCenterEntityStrategy
 *
 * @package TravelCenterModel\Hydrator\Strategy
 */
class TravelCenterEntityStrategy implements StrategyInterface
{
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * TravelCenterEntityStrategy constructor.
     *
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @param integer|TravelCenterEntity $value
     *
     * @return mixed
     */
    public function extract($value)
    {
        if ($value instanceof TravelCenterEntity) {
            return $value->getId();
        }

        return $value;
    }

    /**
     * @param mixed $value
     * @param array $data
     *
     * @return mixed
     */
    public function hydrate($value, $data = [])
    {
        $travelcenterData = [];

        foreach ($data as $key => $value) {
            if (substr($key, 0, 8) != 'travelcenter_') {
                continue;
            }

            $travelcenterData[substr($key, 8)] = $value;
        }

        $travelcenterEntity = new TravelCenterEntity();

        $this->hydrator->hydrate($travelcenterData, $travelcenterEntity);

        return $travelcenterEntity;
    }
}
