<?php // Server side login validation
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$curs = oci_new_cursor($conn);
$stid = oci_parse($conn, "begin userutils.find_user(:cursbv,'$username'); end;");
oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
oci_execute($stid);

oci_execute($curs);

if (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    if (password_verify($password, $row['PASS'])) {
        $_SESSION['username'] = $row['USERNAME'];
        $_SESSION["id"] = $row['ID_UZYTKOWNIK'];
        $_SESSION["typ_konta"] = $row['TYP_KONTA'];
    if($row['TYP_KONTA'] == 1){
        echo 1;
    }
    else {
        echo 0;
    }
    }
    else {
        echo -1;
    }
}
else  {
    echo -1;
}
oci_free_statement($stid);
oci_free_statement($curs);
oci_close($conn);  

?>
