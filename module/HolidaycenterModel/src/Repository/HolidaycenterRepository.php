<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterModel\Repository;

use HolidaycenterModel\Entity\HolidaycenterEntity;
use HolidaycenterModel\Storage\HolidaycenterStorageInterface;
use DateTime;
use Zend\Paginator\Paginator;

/**
 * Class HolidaycenterRepository
 *
 * @package HolidaycenterModel\Repository
 */
class HolidaycenterRepository implements HolidaycenterRepositoryInterface
{
    /**
     * @var HolidaycenterStorageInterface
     */
    private $holidaycenterStorage;

    /**
     * HolidaycenterRepository constructor.
     *
     * @param HolidaycenterStorageInterface $holidaycenterStorage
     */
    public function __construct(HolidaycenterStorageInterface $holidaycenterStorage)
    {
        $this->holidaycenterStorage = $holidaycenterStorage;
    }

    /**
     * Get all companies for a given page
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function getCompaniesByPage($page = 1, $count = 5)
    {
        return $this->holidaycenterStorage->fetchHolidaycenterCollection(
            $page, $count
        );
    }

    /**
     * Get a single holidaycenter by id
     *
     * @param $id
     *
     * @return HolidaycenterEntity|bool
     */
    public function getSingleHolidaycenterById($id)
    {
        return $this->holidaycenterStorage->fetchHolidaycenterEntity($id);
    }

    /**
     * Get holidaycenter options
     *
     * @return array
     */
    public function getHolidaycenterOptions()
    {
        return $this->holidaycenterStorage->fetchHolidaycenterOptions();
    }

    /**
     * Create a new holidaycenter based on array data
     *
     * @param array $data
     *
     * @return HolidaycenterEntity
     */
    public function createHolidaycenterFromData(array $data = [])
    {
        $nextId = $this->holidaycenterStorage->nextId();

        $holidaycenter = new HolidaycenterEntity();
        $holidaycenter->setId($nextId);
        $holidaycenter->setRegistered(new DateTime());
        $holidaycenter->setUpdated(new DateTime());
        $holidaycenter->setStatus($data['status']);
        $holidaycenter->setName($data['name']);
        $holidaycenter->setEmail($data['email']);
        $holidaycenter->setContact($data['contact']);

        return $holidaycenter;
    }

    /**
     * Save holidaycenter
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return boolean
     */
    public function saveHolidaycenter(HolidaycenterEntity $holidaycenter)
    {
        if (!$holidaycenter->getId()) {
            return $this->holidaycenterStorage->insertHolidaycenter($holidaycenter);
        } else {
            return $this->holidaycenterStorage->updateHolidaycenter($holidaycenter);
        }
    }

    /**
     * Delete an holidaycenter
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return boolean
     */
    public function deleteHolidaycenter(HolidaycenterEntity $holidaycenter)
    {
        return $this->holidaycenterStorage->deleteHolidaycenter($holidaycenter);
    }
}
