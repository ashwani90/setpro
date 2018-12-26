<?php
/**
 * Document User
 *
 * This file contains the structure of the User object that will stored in the database.
 *
 * @category   Document
 * @author     Ashwani
 * @since      0.0.0
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreUpdate;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;

/**
 * Class Document User
 * @package App\Document
 *
 * @Document(collection="users")
 * @Document @HasLifecycleCallbacks
 */
class User
{

    /**
     * @Id
     */
    private $id;

    /**
     * @Field(type="string")
     */
    private $name;

    /**
     * @Field(type="string")
     * @Index(unique=true, order="asc")
     */
    private $email;

    /**
     * @Field(type="string")
     */
    private $roles;

    /**
     * @Field(type="string")
     */
    private $password;

    /**
     * @Field(type="string")
     */
    private $address;

    /**
     * @Field(type="string")
     * @Index(unique=true, order="asc")
     */
    private $phoneNumber;

    /**
     * @Field(type="date")
     */
    private $createDate;

    /**
     * @Field(type="date")
     */
    private $lastUpdateDate;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     *
     * @return User
     */
    public function setEmail($email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return object
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param object $roles
     *
     * @return User
     */
    public function setRoles($roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password): User
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address): User
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber): User
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     *
     * @return User
     */
    public function setCreateDate($createDate): User
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * @param \DateTime $lastUpdateDate
     *
     * @return User
     */
    public function setLastUpdateDate($lastUpdateDate): User
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
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
     *
     * @return User
     */
    public function setName($name): User
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @PrePersist()
     */
    public function onPrePersist()
    {
        $date = new \DateTime();
        //Store created date when the entity is created
        $this->createDate = $date;
    }

    /**
     * @PreUpdate()
     */
    public function onPreUpdate()
    {
        //Update last update time when entity updates
        $date = new \DateTime();
        $this->lastUpdateDate = $date;
    }
}