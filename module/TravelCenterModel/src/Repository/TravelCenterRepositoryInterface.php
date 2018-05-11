<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\Repository;

use TravelCenterModel\Entity\TravelCenterEntity;
use Zend\Paginator\Paginator;

/**
 * Interface TravelCenterRepositoryInterface
 *
 * @package TravelCenterModel\Repository
 */
interface TravelCenterRepositoryInterface
{
    /**
     * Get all travelcenters for a given page
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function getTravelCentersByPage($page = 1, $count = 5);

    /**
     * Get a single travelcenter by id
     *
     * @param $id
     *
     * @return TravelCenterEntity|bool
     */
    public function getSingleTravelCenterById($id);

    /**
     * Get travelcenter options
     *
     * @return array
     */
    public function getTravelCenterOptions();

    /**
     * Create a new travelcenter based on array data
     *
     * @param array $data
     *
     * @return TravelCenterEntity
     */
    public function createTravelCenterFromData(array $data = []);

    /**
     * Save travelcenter
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return boolean
     */
    public function saveTravelCenter(TravelCenterEntity $travelcenter);

    /**
     * Delete an travelcenter
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return boolean
     */
    public function deleteTravelCenter(TravelCenterEntity $travelcenter);
}
