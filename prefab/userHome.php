<div class="container">
</div>

<?php
function sprawdzRezerwacje()
{
 
    session_start();
    $success = include "./phpScripts/config2.php";

    if (!$success) {
        include "../phpScripts/config2.php";
    }
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin user_profile.user_bookings(:cursbv, '" . $_SESSION['username'] . "'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    $nie_oplacone = false;
    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        if (($row['CZY_OPLACONY'] == 0) && (date($row['DATA_ODLOTU']) > date("d-m-y h:i"))) {
            $nie_oplacone = true;
        }
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
    return $nie_oplacone;
}

function najblizszeLoty()
{
 
    $success = include "./phpScripts/config2.php";

    if (!$success) {
        include "../phpScripts/config2.php";
    }
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin user_profile.user_upcoming(:cursbv, '" . $_SESSION['username'] . "'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo '<center>';
        echo '<div class="alert alert-primary" role="alert">';
        echo "Masz lot w dniu " . $row['DATA_ODLOTU'] . " :)";
        echo '</div>';
        echo '</center>';
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}
?>



<div class="container" style="width:66%;">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
            <?php 
            if (@sprawdzRezerwacje()) {
                echo '<center>';
                echo '<div class="alert alert-danger" role="alert">';
                echo "Masz nie opłacone rezerwacje :) Radzę zajrzeć na panel rezerwacji :)";
                echo '</div>';
                echo '</center>';
            }
            @najblizszeLoty();
            ?>
            </div>
        </div>
    </div>
</div>

