<?php
function get_Kraje() {
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin search_flight.countries(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<option value=" . $row['KRAJ'] . ">";

    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);

}

function get_Miasta() {
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin search_flight.cities(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<option value=" . $row['MIASTO'] . ">";

    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);

}

?>