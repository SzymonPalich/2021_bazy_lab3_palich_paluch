<?php
include "config.php";

$id = $_POST['id'];
$m_odlotu = $_POST['m_odlotu'];
$m_przylotu = $_POST['m_przylotu'];
$samolot = $_POST['samolot'];
$d_odlotu = $_POST['d_odlotu'];
$d_przylotu = $_POST['d_przylotu'];


$command = $_POST['command'];


if ($command == "DELETE") {
    $sql = "begin loty_diu.loty_delete(". $id ."); end;";
}
elseif ($command == "INSERT") {
    $sql = "begin loty_diu.loty_insert('". $m_odlotu . "','" . $m_przylotu . "','" . $samolot . "','" . $d_odlotu . "','" . $d_przylotu . "'); end;";
}
elseif ($command == "UPDATE") {
    $sql = "begin loty_diu.loty_update('". $id . "','" . $m_odlotu . "','" . $m_przylotu . "','" . $samolot . "','" . $d_odlotu . "','" . $d_przylotu ."'); end;";
}

echo $sql;

$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn); 




?>