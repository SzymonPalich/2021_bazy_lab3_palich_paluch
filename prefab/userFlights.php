<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Data odlotu</th>
                            <th>Miejsce odlotu</th>
                            <th>Miejsce przylotu</th>
                            <th>Bagaz</th>
                            <th>Cena biletu</th>
                            <th>Drukuj</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php getBookings(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
function getBookings()
{
    include "../phpScripts/config.php";
    //  (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .
    $curs = oci_new_cursor($conn);
    // $_SESSION['username']
    $stid = oci_parse($conn, "begin user_profile.user_bookings(:cursbv, '" . $_SESSION['username'] . "'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    $isEmpty = true;
    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        if ($row['CZY_OPLACONY'] == 1) {
            $isEmpty = false;
            echo "<td>" . $row['DATA_ODLOTU'] . "</td>";
            echo "<td>" . $row['MIEJSCE_ODLOTU'] . "</td>";
            echo "<td>" . $row['MIEJSCE_PRZYLOTU'] . "</td>";
            echo "<td>" . $row['BAGAZ'] . "</td>";
            echo "<td>" . $row['CENA'] . "</td>";
            echo "<td><button class='btn btn-danger' onclick='drukuj(".$row['ID_BILET'].")'>Drukuj</button></td>";

        }
        echo "</tr>";
    }
    if ($isEmpty) {
        echo "<tr>";
        echo "<td>" . "BRAK" . "</td>";
        echo "<td>" . "BRAK" . "</td>";
        echo "<td>" . "BRAK" . "</td>";
        echo "<td>" . "BRAK" . "</td>";
        echo "<td>" . "BRAK" . "</td>";
        echo "<td>" . "BRAK" . "</td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function cancelBooking($id)
{
    include "../phpScripts/config.php";
    $stid = oci_parse($conn, "begin user_profile.user_cancel('" . $id . "'); end;");
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conn);
}
?>