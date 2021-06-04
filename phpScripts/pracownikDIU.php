<?php
include "config.php";

$id = $_POST['id'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$stanowisko = $_POST['stanowisko'];
$pensja = $_POST['pensja'];
$command = $_POST['command'];


if ($command == "DELETE") {
    $sql = "begin pracownicy_diu.pracownik_delete(". $id ."); end;";
}
elseif ($command == "INSERT") {
    $sql = "begin pracownicy_diu.pracownik_insert('". $imie . "','" . $nazwisko . "','" . $stanowisko . "','" . $pensja . "'); end;";
}
elseif ($command == "UPDATE") {
    $sql = "begin pracownicy_diu.pracownik_update('". $id . "','" . $imie . "','" . $nazwisko . "','" . $stanowisko . "','" . $pensja . "'); end;";
}

echo $sql;

$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 




?>g