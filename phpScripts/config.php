<?php // Database Connection
session_start();

$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)))(CONNECT_DATA=(SERVICE_NAME=ORCLCDB.localdomain)))" ;
$conn = oci_connect("szymon", "szymon", $db);
if (!$conn) {
    die("Connection failed: " . oci_error());
}
?>