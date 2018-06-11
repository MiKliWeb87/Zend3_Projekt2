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
use Zend\Paginator\Paginator;

/**
 * Interface HolidaycenterRepositoryInterface
 *
 * @package HolidaycenterModel\Repository
 */
interface HolidaycenterRepositoryInterface
{
    /**
     * Get all companies for a given page
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function getCompaniesByPage($page = 1, $count = 5);

    /**
     * Get a single holidaycenter by id
     *
     * @param $id
     *
     * @return HolidaycenterEntity|bool
     */
    public function getSingleHolidaycenterById($id);

    /**
     * Get holidaycenter options
     *
     * @return array
     */
    public function getHolidaycenterOptions();

    /**
     * Create a new holidaycenter based on array data
     *
     * @param array $data
     *
     * @return HolidaycenterEntity
     */
    public function createHolidaycenterFromData(array $data = []);

    /**
     * Save holidaycenter
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return boolean
     */
    public function saveHolidaycenter(HolidaycenterEntity $holidaycenter);

    /**
     * Delete an holidaycenter
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return boolean
     */
    public function deleteHolidaycenter(HolidaycenterEntity $holidaycenter);
}
