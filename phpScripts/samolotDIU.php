<?php
include "config.php";

$id = $_POST['id'];
$id_typ = $_POST['id_typ'];
$marka = $_POST['marka'];
$model = $_POST['model'];
$l_miejsc = $_POST['l_miejsc'];
$command = $_POST['command'];

if ($command == "DELETE") {
    $sql = "begin samoloty_diu.samolot_delete(". $id ."); end;";
}
elseif ($command == "INSERT") {
    $sql = "begin samoloty_diu.samolot_insert('". $id_typ . "','" . $marka . "','" . $model . "','" . $l_miejsc . "'); end;";
}
elseif ($command == "UPDATE") {
    $sql = "begin samoloty_diu.samolot_update('". $id . "','" . $id_typ . "','" . $marka . "','" . $model . "','" . $l_miejsc . "'); end;";
}

echo $sql;

$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 




?>