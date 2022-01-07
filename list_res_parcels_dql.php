<?php
// list_res_parcels.php <res-id>
require_once "bootstrap.php";

 
$id = $argv[1];
 
// $dql = "SELECT p  FROM Residency p WHERE p.id= ?1";
$dql = "SELECT p,q  FROM Residency p JOIN p.parcels q WHERE p.id= ?1";

$res = $entityManager->createQuery($dql) 
         ->setParameter(1, $id)
         ->getResult();
foreach ($res[0]->getParcels() as $parcel) {
    echo "    Parcel: ".$parcel->getName()."\n";
}