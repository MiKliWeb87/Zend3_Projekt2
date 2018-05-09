<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\Storage;

use TravelCenterModel\Entity\TravelCenterEntity;
use Zend\Paginator\Paginator;

/**
 * Interface TravelCenterStorageInterface
 *
 * @package TravelCenterModel\Storage
 */
interface TravelCenterStorageInterface
{
    /**
     * Fetch an travelcenter collection by type from storage
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function fetchTravelCenterCollection($page = 1, $count = 5);

    /**
     * Fetch an travelcenter entity by id from storage
     *
     * @param $id
     *
     * @return TravelCenterEntity
     */
    public function fetchTravelCenterEntity($id);

    /**
     * Fetch all travelcenters for an option list
     *
     * @return mixed
     */
    public function fetchTravelCenterOptions();

    /**
     * Get next id for travelcenter entity
     *
     * @return integer
     */
    public function nextId();

    /**
     * Insert new travelcenter entity to storage
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return mixed
     */
    public function insertTravelCenter(TravelCenterEntity $travelcenter);

    /**
     * Update existing travelcenter entity in storage
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return mixed
     */
    public function updateTravelCenter(TravelCenterEntity $travelcenter);

    /**
     * Delete existing travelcenter entity from storage
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return mixed
     */
    public function deleteTravelCenter(TravelCenterEntity $travelcenter);
}