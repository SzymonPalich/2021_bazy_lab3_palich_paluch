<?php
include "config.php";

$id = $_POST['id'];
$waga_bagazu_podrecznego = $_POST['waga_bagazu_podrecznego'];
$waga_bagazu_rejestrowanego = $_POST['waga_bagazu_rejestrowanego'];
$command = $_POST['command'];


if ($command == "DELETE") {
    $sql = "begin bagaze_diu.bagaze_delete(". $id ."); end;";
}
elseif ($command == "INSERT") {
    $sql = "begin bagaze_diu.bagaze_insert('" . $waga_bagazu_podrecznego . "','" . $waga_bagazu_rejestrowanego . "'); end;";
}
elseif ($command == "UPDATE") {
    $sql = "begin bagaze_diu.bagaze_update('". $id . "','" . $waga_bagazu_podrecznego . "','" . $waga_bagazu_rejestrowanego . "'); end;";
}

echo $sql;
$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 




?>