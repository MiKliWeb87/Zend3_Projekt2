<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterModel\Storage;

use HolidaycenterModel\Entity\HolidaycenterEntity;
use Zend\Paginator\Paginator;

/**
 * Interface HolidaycenterStorageInterface
 *
 * @package HolidaycenterModel\Storage
 */
interface HolidaycenterStorageInterface
{
    /**
     * Fetch an holidaycenter collection by type from storage
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function fetchHolidaycenterCollection($page = 1, $count = 5);

    /**
     * Fetch an holidaycenter entity by id from storage
     *
     * @param $id
     *
     * @return HolidaycenterEntity
     */
    public function fetchHolidaycenterEntity($id);

    /**
     * Fetch all companies for an option list
     *
     * @return mixed
     */
    public function fetchHolidaycenterOptions();

    /**
     * Get next id for holidaycenter entity
     *
     * @return integer
     */
    public function nextId();

    /**
     * Insert new holidaycenter entity to storage
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return mixed
     */
    public function insertHolidaycenter(HolidaycenterEntity $holidaycenter);

    /**
     * Update existing holidaycenter entity in storage
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return mixed
     */
    public function updateHolidaycenter(HolidaycenterEntity $holidaycenter);

    /**
     * Delete existing holidaycenter entity from storage
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return mixed
     */
    public function deleteHolidaycenter(HolidaycenterEntity $holidaycenter);
}