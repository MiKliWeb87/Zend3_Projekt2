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
use TravelCenterModel\Storage\TravelCenterStorageInterface;
use DateTime;
use Zend\Paginator\Paginator;

/**
 * Class TravelCenterRepository
 *
 * @package TravelCenterModel\Repository
 */
class TravelCenterRepository implements TravelCenterRepositoryInterface
{
    /**
     * @var TravelCenterStorageInterface
     */
    private $travelcenterStorage;

    /**
     * TravelCenterRepository constructor.
     *
     * @param TravelCenterStorageInterface $travelcenterStorage
     */
    public function __construct(TravelCenterStorageInterface $travelcenterStorage)
    {
        $this->travelcenterStorage = $travelcenterStorage;
    }

    /**
     * Get all travelcenters for a given page
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function getTravelCentersByPage($page = 1, $count = 5)
    {
        return $this->travelcenterStorage->fetchTravelCenterCollection(
            $page, $count
        );
    }

    /**
     * Get a single travelcenter by id
     *
     * @param $id
     *
     * @return TravelCenterEntity|bool
     */
    public function getSingleTravelCenterById($id)
    {
        return $this->travelcenterStorage->fetchTravelCenterEntity($id);
    }

    /**
     * Get travelcenter options
     *
     * @return array
     */
    public function getTravelCenterOptions()
    {
        return $this->travelcenterStorage->fetchTravelCenterOptions();
    }

    /**
     * Create a new travelcenter based on array data
     *
     * @param array $data
     *
     * @return TravelCenterEntity
     */
    public function createTravelCenterFromData(array $data = [])
    {
        $nextId = $this->travelcenterStorage->nextId();

        $travelcenter = new TravelCenterEntity();
        $travelcenter->setId($nextId);
        $travelcenter->setRegistered(new DateTime());
        $travelcenter->setUpdated(new DateTime());
        $travelcenter->setStatus($data['status']);
        $travelcenter->setName($data['name']);
        $travelcenter->setEmail($data['email']);
        $travelcenter->setContact($data['contact']);

        return $travelcenter;
    }

    /**
     * Save travelcenter
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return boolean
     */
    public function saveTravelCenter(TravelCenterEntity $travelcenter)
    {
        if (!$travelcenter->getId()) {
            return $this->travelcenterStorage->insertTravelCenter($travelcenter);
        } else {
            return $this->travelcenterStorage->updateTravelCenter($travelcenter);
        }
    }

    /**
     * Delete an travelcenter
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return boolean
     */
    public function deleteTravelCenter(TravelCenterEntity $travelcenter)
    {
        return $this->travelcenterStorage->deleteTravelCenter($travelcenter);
    }
}
