<?php
// create_parcel.php <parcel-name> <residence-id>  
require_once "bootstrap.php";

$name = $argv[1];
$resId = $argv[2];

$res = $entityManager->find("Residency", $resId);
 if (!$res) {
    echo "No residency found for the given id.\n";
    exit(1);
}

$parcel = new Parcel();
$parcel->setName( $name );
 
$parcel->setResidency($res);

$entityManager->persist($parcel);
$entityManager->flush();

echo "Your new Parcel Id: ".$parcel->getId()."\n";