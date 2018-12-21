<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 19/12/18
 * Time: 5:14 PM
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/** @Document(collection="userType") */
class UserType
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
     * @Field(type="int")
     */
    private $value;

    /**
     * @Field(type="timestamp")
     */
    private $createdDate;

    /**
     * @Field(type="timestamp")
     */
    private $lastUpdatedDate;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return UserType
     */
    public function setName($name): UserType
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     *
     * @return UserType
     */
    public function setValue($value): UserType
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     *
     * @return UserType
     */
    public function setCreatedDate($createdDate): UserType
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdatedDate()
    {
        return $this->lastUpdatedDate;
    }

    /**
     * @param \DateTime $lastUpdatedDate
     *
     * @return UserType
     */
    public function setLastUpdatedDate($lastUpdatedDate): UserType
    {
        $this->lastUpdatedDate = $lastUpdatedDate;

        return $this;
    }
}