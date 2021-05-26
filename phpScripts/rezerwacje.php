<?php
include "config.php";

$id = $_POST['id'];
$command = $_POST['command'];

if ($command == "DELETE") {
    $sql = "begin bilety_diu.bilety_delete(". $id ."); end;";
}

elseif ($command == "UPDATE") {
    $sql = "begin bilety_diu.oplac_bilet('". $id . "'); end;";
}

echo $sql;
$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 


?>