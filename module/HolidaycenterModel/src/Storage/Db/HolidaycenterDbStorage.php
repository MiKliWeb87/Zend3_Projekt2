<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterModel\Storage\Db;

use HolidaycenterModel\Entity\HolidaycenterEntity;
use HolidaycenterModel\Storage\HolidaycenterStorageInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Hydrator\HydratorInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

/**
 * Class HolidaycenterDbStorage
 *
 * @package HolidaycenterModel\Storage\Db
 */
class HolidaycenterDbStorage implements HolidaycenterStorageInterface
{
    /**
     * @var TableGatewayInterface|TableGateway
     */
    private $tableGateway;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * HolidaycenterDbStorage constructor.
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;

        /** @var HydratingResultSet $resultSetPrototype */
        $resultSetPrototype = $this->tableGateway->getResultSetPrototype();

        $this->hydrator = $resultSetPrototype->getHydrator();
    }

    /**
     * Fetch an holidaycenter collection by type from storage
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function fetchHolidaycenterCollection($page = 1, $count = 5)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->order(['name' => 'ASC']);

        $dbSelectAdapter = new DbSelect(
            $select,
            $this->tableGateway->getAdapter(),
            $this->tableGateway->getResultSetPrototype()
        );

        $paginator = new Paginator($dbSelectAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($count);

        return $paginator;
    }

    /**
     * Fetch an holidaycenter entity by id from storage
     *
     * @param $id
     *
     * @return HolidaycenterEntity
     */
    public function fetchHolidaycenterEntity($id)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        return $resultSet->current();
    }

    /**
     * Fetch all holidaycenters for an option list
     *
     * @return mixed
     */
    public function fetchHolidaycenterOptions()
    {
        $select = $this->tableGateway->getSql()->select();

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        $options = [];

        /** @var HolidaycenterEntity $holidaycenter */
        foreach ($resultSet as $holidaycenter) {
            $options[$holidaycenter->getId()] = $holidaycenter->getName();
        }

        return $options;
    }

    /**
     * Get next id for holidaycenter entity
     *
     * @return integer
     */
    public function nextId()
    {
        $insert = $this->tableGateway->getSql()->insert();
        $insert->values(['id' => null]);

        $this->tableGateway->insertWith($insert);

        return $this->tableGateway->getLastInsertValue();
    }

    /**
     * Insert new holidaycenter entity to storage
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return mixed
     */
    public function insertHolidaycenter(HolidaycenterEntity $holidaycenter)
    {
        $insertData = $this->hydrator->extract($holidaycenter);

        $insert = $this->tableGateway->getSql()->insert();
        $insert->values($insertData);

        return $this->tableGateway->insertWith($insert) > 0;
    }

    /**
     * Update existing holidaycenter entity in storage
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return mixed
     */
    public function updateHolidaycenter(HolidaycenterEntity $holidaycenter)
    {
        $updateData = $this->hydrator->extract($holidaycenter);

        $update = $this->tableGateway->getSql()->update();
        $update->set($updateData);
        $update->where->equalTo('id', $holidaycenter->getId());

        return $this->tableGateway->updateWith($update) > 0;
    }

    /**
     * Delete existing holidaycenter entity from storage
     *
     * @param HolidaycenterEntity $holidaycenter
     *
     * @return mixed
     */
    public function deleteHolidaycenter(HolidaycenterEntity $holidaycenter)
    {
        $delete = $this->tableGateway->getSql()->delete();
        $delete->where->equalTo('id', $holidaycenter->getId());

        return $this->tableGateway->deleteWith($delete) > 0;
    }
}
