<?php
// src/Product.php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="parcels")
 */
class Parcel
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /** 
     * @ORM\Column(type="string") 
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
     * @ORM\ManyToOne(targetEntity="Residency",  inversedBy="parcels")
     **/
    protected $residency;
    public function setResidency(Residency $residency)
    {
        $residency->addParcel($this);
        $this->residency = $residency;
    }
 }