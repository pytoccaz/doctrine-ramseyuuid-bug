<?php
// src/Bug.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity  
 * @ORM\Table(name="book")
 */
class Book
{
    /**
     * @var Ulid
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $title;
 

    /**
     * @ORM\OneToOne(targetEntity="Author", mappedBy="book", cascade={"persist", "remove"})
     * @var Author
     */
    protected $author;


    public function __construct(string $title, ?Author $author = null) {
        $this->setTitle($title);
        $this->setAuthor($author);
    }


    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
 

    public function getTitle():?string
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
 

    public function getAuthor():?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author):self
    {
        $this->author = $author;

        // set the owning side of the relation
        if ($author) $author->setBook($this);

        return $this ;
    }
}