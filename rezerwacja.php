<?php
include "phpScripts/config.php";

$bag_podr = $_POST['bag_podr'];
$bag_rej = $_POST['bag_rej'];

$id_lot = $_REQUEST["id"];
$cena = $_POST['cena'];
$_SESSION["id"];

if ($bag_podr == "") {
    $bag_podr == 0;
}
if ($bag_rej == "") {
    $bag_rej == 0;
}

$sql = "begin get_pasazer('" . $_SESSION["id"] . "', :out_id_pasazer); end;";

$stmt = oci_parse($conn, $sql);

oci_bind_by_name($stmt, ':out_id_pasazer', $id_pasazer, 32);

oci_execute($stmt);

oci_free_statement($stmt);


$sql = "begin elegancki_insert_biletu('" . $bag_podr . "','" . $bag_rej . "','" . $id_pasazer . "','" . $id_lot . "','" . $cena . "'); end;";
echo $sql;
$stmt = oci_parse($conn, $sql);

oci_execute($stmt);

oci_free_statement($stmt);

oci_close($conn);

header( "Location: user.php" )
?>