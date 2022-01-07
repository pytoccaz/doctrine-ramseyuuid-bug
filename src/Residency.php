<?php
// src/Residency.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity 
 * @ORM\Table(name="residencies")
 */
class Residency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @ORM\OneToMany(targetEntity="Parcel", mappedBy="residency")
     * @var Parcel[] An ArrayCollection of Parcel objects.
     */
    protected $parcels;
    
    public function __construct()
    {
        $this->parcels = new ArrayCollection();
    }

    public function getParcels()
    {
        return $this->parcels;
    }


     public function addParcel(Parcel $parcel)
    {
        $this->parcels[] = $parcel;
    }
}