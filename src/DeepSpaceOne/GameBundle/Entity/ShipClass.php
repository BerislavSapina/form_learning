<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeepSpaceOne\GameBundle\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A space ship class.
 *
 * @Entity
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ShipClass
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     *
     * @var integer
     */
    private $id;

    /**
     * Name of the class.
     *
     * @Column(type="string")
     *
     * @Assert\NotNull
     * @Assert\Length(min=3, minMessage="Please enter at least 3 characters.")
     *
     * @var string
     */
    private $name;

    /**
     * Price of a ship of that class in credits.
     *
     * @Column(type="integer", nullable=false)
     *
     * @Assert\NotNull
     * @Assert\GreaterThan(0)
     *
     * @var integer
     */
    private $price;

    /**
     * Payload capacity in tons.
     *
     * @Column(type="integer")
     *
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(0)
     *
     * @var integer
     */
    private $payloadCapacity;

    /**
     * Number of slots for mounting equipment.
     *
     * @Column(type="integer")
     *
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(0)
     *
     * @var integer
     */
    private $mountPointCapacity;

    /**
     * The number of crew members required to fly the ship.
     *
     * @Column(type="integer")
     *
     * @Assert\NotNull
     * @Assert\GreaterThan(0)
     *
     * @var integer
     */
    private $crewSize;

    public function __construct($name = null, $price = 2000, $payloadCapacity = 50, $crewSize = 2, $mountPointCapacity = 2)
    {
        $this->name = $name;
        $this->price = $price;
        $this->payloadCapacity = $payloadCapacity;
        $this->crewSize = $crewSize;
        $this->mountPointCapacity = $mountPointCapacity;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $crewSize
     */
    public function setCrewSize($crewSize)
    {
        $this->crewSize = $crewSize;
    }

    /**
     * @return int
     */
    public function getCrewSize()
    {
        return $this->crewSize;
    }

    /**
     * @param integer $mountPointCapacity
     */
    public function setMountPointCapacity($mountPointCapacity)
    {
        $this->mountPointCapacity = $mountPointCapacity;
    }

    /**
     * @return int
     */
    public function getMountPointCapacity()
    {
        return $this->mountPointCapacity;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $payloadCapacity
     */
    public function setPayloadCapacity($payloadCapacity)
    {
        $this->payloadCapacity = $payloadCapacity;
    }

    /**
     * @return int
     */
    public function getPayloadCapacity()
    {
        return $this->payloadCapacity;
    }

    /**
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}
