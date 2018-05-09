<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\Storage\Db;

use TravelCenterModel\Entity\TravelCenterEntity;
use TravelCenterModel\Storage\TravelCenterStorageInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Hydrator\HydratorInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

/**
 * Class TravelCenterDbStorage
 *
 * @package TravelCenterModel\Storage\Db
 */
class TravelCenterDbStorage implements TravelCenterStorageInterface
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
     * TravelCenterDbStorage constructor.
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
     * Fetch an travelcenter collection by type from storage
     *
     * @param int $page
     * @param int $count
     *
     * @return Paginator
     */
    public function fetchTravelCenterCollection($page = 1, $count = 5)
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
     * Fetch an travelcenter entity by id from storage
     *
     * @param $id
     *
     * @return TravelCenterEntity
     */
    public function fetchTravelCenterEntity($id)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        return $resultSet->current();
    }

    /**
     * Fetch all travelcenters for an option list
     *
     * @return mixed
     */
    public function fetchTravelCenterOptions()
    {
        $select = $this->tableGateway->getSql()->select();

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        $options = [];

        /** @var TravelCenterEntity $travelcenter */
        foreach ($resultSet as $travelcenter) {
            $options[$travelcenter->getId()] = $travelcenter->getName();
        }

        return $options;
    }

    /**
     * Get next id for travelcenter entity
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
     * Insert new travelcenter entity to storage
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return mixed
     */
    public function insertTravelCenter(TravelCenterEntity $travelcenter)
    {
        $insertData = $this->hydrator->extract($travelcenter);

        $insert = $this->tableGateway->getSql()->insert();
        $insert->values($insertData);

        return $this->tableGateway->insertWith($insert) > 0;
    }

    /**
     * Update existing travelcenter entity in storage
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return mixed
     */
    public function updateTravelCenter(TravelCenterEntity $travelcenter)
    {
        $updateData = $this->hydrator->extract($travelcenter);

        $update = $this->tableGateway->getSql()->update();
        $update->set($updateData);
        $update->where->equalTo('id', $travelcenter->getId());

        return $this->tableGateway->updateWith($update) > 0;
    }

    /**
     * Delete existing travelcenter entity from storage
     *
     * @param TravelCenterEntity $travelcenter
     *
     * @return mixed
     */
    public function deleteTravelCenter(TravelCenterEntity $travelcenter)
    {
        $delete = $this->tableGateway->getSql()->delete();
        $delete->where->equalTo('id', $travelcenter->getId());

        return $this->tableGateway->deleteWith($delete) > 0;
    }
}
