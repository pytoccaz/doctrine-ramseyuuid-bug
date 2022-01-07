<?php
// list_product_bugs.php <product-id>
require_once "bootstrap.php";


$id = $argv[1];
 
$dql = "SELECT p,b FROM Product p JOIN b.bugs WHERE p.id= ?1";

$product = $entityManager->createQuery($dql) 
         ->setParameter(1, $id)
         ->getResult();



foreach ($product[0]->openBugs() as $bug) {
    echo "    Bug: ".$bug->getDescription()."\n";
}