<?php
include 'config.php';

$choice = $_POST['choice'];
$username = $_POST['username'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$e_mail = $_POST['e_mail'];
$number = $_POST['number'];

if ($choice == "DEL") {
    session_destroy();
    $query = "BEGIN user_profile.user_del('".$username."'); END;";
} 
elseif ($choice == "EDIT") {
    $query = "BEGIN user_profile.user_edit('".$username."','".$name."','".$surname."','".$e_mail."','".$number."'); END;";
}

$stid = oci_parse($conn, $query);
echo $query;
oci_execute($stid);
oci_free_statement($stid);
oci_close($conn);
