<?php
// update_bug_add_product.php <bug-id> <product-ids>
require_once "bootstrap.php";

$bugId = $argv[1];
$productIds = explode(",", $argv[2]);

$bug = $entityManager->find("Bug", $bugId);


foreach ($productIds as $productId) {
    $product = $entityManager->find("Product", $productId);
    $bug->assignToProduct($product);
}

//$entityManager->persist($bug);
$entityManager->flush();
echo "Your Bug is updated !\n";