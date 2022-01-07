<?php
// list_product_bugs.php <product-id>
require_once "bootstrap.php";


$id = $argv[1];
 

$product = $entityManager->find('Product', $id);

 
foreach ($product->openBugs() as $bug) {
    echo "    Bug: ".$bug->getDescription()."\n";
}