<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterModel\Hydrator\Strategy;

use HolidaycenterModel\Entity\HolidaycenterEntity;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class HolidaycenterEntityStrategy
 *
 * @package HolidaycenterModel\Hydrator\Strategy
 */
class HolidaycenterEntityStrategy implements StrategyInterface
{
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * HolidaycenterEntityStrategy constructor.
     *
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @param integer|HolidaycenterEntity $value
     *
     * @return mixed
     */
    public function extract($value)
    {
        if ($value instanceof HolidaycenterEntity) {
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
        $holidaycenterData = [];

        foreach ($data as $key => $value) 
		{
			/** 
			*  Hier Änderung der Anzahl der Buchstaben
			* auf die Länge des Schlüsselwortes plus Unterstrich(1 Zeichen)
			*/
            if (substr($key, 0, 14) != 'holidaycenter_') 
			{
                continue;
            }
		
            $holidaycenterData[substr($key, 14)] = $value; //Hier Änderung der Anzahl der Buchstaben
        }

        $holidaycenterEntity = new HolidaycenterEntity();

        $this->hydrator->hydrate($holidaycenterData, $holidaycenterEntity);

        return $holidaycenterEntity;
    }
}
