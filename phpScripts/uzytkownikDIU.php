<?php
include "config.php";

$id = $_POST['id'];
$username = $_POST['username'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$typ_konta = $_POST['typ_konta'];
$command = $_POST['command'];


if ($command == "DELETE") {
    $sql = "begin uzytkownicy_diu.uzytkownik_delete(". $id ."); end;";
}
elseif ($command == "INSERT") {
    
    $sql = "begin uzytkownicy_diu.uzytkownik_insert('". $username . "','" . $pass . "'," . $typ_konta . "); end;";
}
elseif ($command == "UPDATE") {
    $sql = "begin uzytkownicy_diu.uzytkownik_update(". $id . ",'" . $username . "','" . $pass . "','" . $typ_konta . "'); end;";
}

$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 




?>