<?php
// src/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity 
 * @ORM\Table(name="author")
 */
class Author
{  
    /**
     * owning side 
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Book", inversedBy="author")
     */
    protected $book;

    /**
     * @ORM\Column(type="string", nullable="true" )
     * @var string
     */
    protected $name;


    public function __construct(?string $name) {
        $this->setName($name);
    }


    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(Book $book): self
    {
        $this->book = $book;
        return $this;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
 
}