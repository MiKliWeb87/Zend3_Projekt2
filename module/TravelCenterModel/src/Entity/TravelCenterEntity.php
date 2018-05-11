<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterModel\Entity;

use DateTime;

/**
 * Class TravelCenterEntity
 *
 * @package TravelCenterModel\Entity
 */
class TravelCenterEntity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var DateTime
     */
    private $registered;

    /**
     * @var DateTime
     */
    private $updated;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var string
     */
    private $logo;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (integer)$id;
    }

    /**
     * @return DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param DateTime $registered
     */
    public function setRegistered(DateTime $registered)
    {
        $this->registered = $registered;
    }

    /**
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        if (!in_array($status, ['new', 'approved', 'blocked'])) {
            $status = 'new';
        }

        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = trim($name);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = trim($email);
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = trim($contact);
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = trim($logo);
    }

    /**
     * Update travelcenter
     */
    public function update()
    {
        $this->setUpdated(new DateTime());
    }

    /**
     * Approve travelcenter
     */
    public function approve()
    {
        $this->setStatus('approved');
        $this->setUpdated(new DateTime());
    }

    /**
     * Block travelcenter
     */
    public function block()
    {
        $this->setStatus('blocked');
        $this->setUpdated(new DateTime());
    }

}
