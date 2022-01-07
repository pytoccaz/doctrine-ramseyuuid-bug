<?php
// create_book.php <book titletitle> <author_name> 
require_once "bootstrap.php";


use App\Entity\Author;
use App\Entity\Book;

$title = $argv[1] ?? "My book";
$authorName = $argv[2] ?? "My author";



$author = $authorName ? new Author($authorName) : null  ; 

$book = new Book($title, $author);
 
$entityManager->persist($book);
$entityManager->flush();

echo "Your new Book Id: ".$book->getId()."\n";

// the error pops up on refresh
$entityManager->refresh($book);
echo "Your new Book Entity was refreshed\n";
