<?php
// list_res_parcels.php <res-id>
require_once "bootstrap.php";
$id = $argv[1];

$res = $entityManager->find('Residency', $id);
foreach ($res->getParcels() as $parcel) {
    echo "    Parcel: ".$parcel->getName()."\n";
}