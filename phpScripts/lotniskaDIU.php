<?php
include "config.php";

$id = $_POST['id'];
$kod_lotniska = $_POST['kod_lotniska'];
$miasto = $_POST['miasto'];
$kraj = $_POST['kraj'];
$command = $_POST['command'];


if ($command == "DELETE") {
    $sql = "begin lotniska_diu.lotnisko_delete(". $id ."); end;";
}
elseif ($command == "INSERT") {
    $sql = "begin lotniska_diu.lotnisko_insert('". $kod_lotniska . "','" . $miasto . "','" . $kraj . "'); end;";
}
elseif ($command == "UPDATE") {
    $sql = "begin lotniska_diu.lotnisko_update('". $id . "','" . $kod_lotniska . "','" . $miasto . "','" . $kraj . "'); end;";
}

echo $sql;
$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 




?>