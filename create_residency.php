<?php
// create_residency.php <name>
require_once "bootstrap.php";

$newResname = $argv[1];

$res = new Residency();
$res->setName($newResname);

$entityManager->persist($res);
$entityManager->flush();

echo "Created Res with ID " . $res->getId() . "\n";
