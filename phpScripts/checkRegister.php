<?php 
include "config.php";

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$curs = oci_new_cursor($conn);
$stid = oci_parse($conn, "begin userutils.check_if_exists(:cursbv,'$username'); end;");
oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
oci_execute($stid);

oci_execute($curs);

if (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    echo 0;
}
else {
    oci_free_statement($stid);
    oci_free_statement($curs);

    $query = "BEGIN add_user('$username','$password'); END;";
    oci_execute(oci_parse($conn, $query));

    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin userutils.find_user(:cursbv,'$username'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);
    $row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS);
    $_SESSION['username'] = $row['USERNAME'];
    $_SESSION["id"] = $row['ID_UZYTKOWNIK'];
    $_SESSION["typ_konta"] = 0;
    echo 1;
}

oci_close($conn);
?>
