<?php
include "config.php";

$id = $_POST['id'];
$pasazer = $_POST['pasazer'];
$lot = $_POST['lot'];
$bagaz = $_POST['bagaz'];
$miejsce = $_POST['miejsce'];
$cena = $_POST['cena'];
$oplacony = $_POST['oplacony'];
$command = $_POST['command'];


if ($command == "DELETE") {
    $sql = "begin bilety_diu.bilety_delete(". $id ."); end;";
}
elseif ($command == "INSERT") {
    $sql = "begin bilety_diu.bilety_insert('". $pasazer . "','" . $lot . "','" . $bagaz . "','" . $miejsce . "','"  . $cena . "','"  . $oplacony . "'); end;";
}
elseif ($command == "UPDATE") {
    $sql = "begin bilety_diu.bilety_update('". $id . "','" . $pasazer . "','" . $lot . "','" . $bagaz . "','" . $miejsce . "','"  . $cena . "','"  . $oplacony . "'); end;";
}

echo $sql;
$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 




?>