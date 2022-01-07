<?php
// src/Product.php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
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
     * @ORM\ManyToMany(targetEntity="Bug", mappedBy="products")
     **/
    protected $bugs;

    public function __construct()
    {
        $this->bugs = new ArrayCollection();
    }
    public function openBugs()
    {
        return $this->bugs;
    }

}