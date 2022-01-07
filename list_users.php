<?php
// list_products.php
require_once "bootstrap.php";

$userRepository = $entityManager->getRepository('User');
$users = $userRepository->findAll();

foreach ($users as $user) {
    echo sprintf("-%s\n", $user->getName());
}