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
 * A good that can be carried by a ship.
 *
 * @Entity
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class Good
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * Name of the good.
     *
     * @Column(type="string", nullable=false)
     *
     * @var string
     *
     * @Assert\NotNull
     * @Assert\Length(min=2,minMessage="Use more characters")
     */
    private $name;

    /**
     * Price of the good per ton in credits.
     *
     * @Column(type="integer", nullable=false)
     *
     * @var integer
     *
     * @Assert\NotNull
     * @Assert\GreaterThan(0)
     */
    private $pricePerTon = 10;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @param integer $pricePerTon
     */
    public function setPricePerTon($pricePerTon)
    {
        $this->pricePerTon = $pricePerTon;
    }

    /**
     * @return integer
     */
    public function getPricePerTon()
    {
        return $this->pricePerTon;
    }

    public function setPricePerTonEuro($pricePerTon){
        $this->pricePerTon =(int) ($pricePerTon / 100);
    }
    public function getPricePerTonEuro()
    {
        return $this->pricePerTon*100;
    }
}
