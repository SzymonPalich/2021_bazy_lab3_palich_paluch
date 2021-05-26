<br>
<div class="container">
    <div class="row"></div>
    <div class="col-xs-12">
        <div class="table-responsive">
            <br>
            <table class="table table-bordered table-hover">
            
                <tr style="background-color: #ff99ff; text-align: center;">
                    <th>Ostatni tydzień</th>
                    <th>Ostatni miesiąc</th>
                    <th>Ostatni kwartał</th>
                </tr>

                <tbody>
                    <?php
                    include "../phpScripts/config2.php";

                    $sql = "begin statystyka_opisowa.ostatnie_zarobki(:ostatni_tydzien, :ostatni_miesiac, :ostatni_kwartal); end;";

                    $stmt = oci_parse($conn, $sql);

                    oci_bind_by_name($stmt, ':ostatni_tydzien', $ostatni_tydzien, 32);
                    oci_bind_by_name($stmt, ':ostatni_miesiac', $ostatni_miesiac, 32);
                    oci_bind_by_name($stmt, ':ostatni_kwartal', $ostatni_kwartal, 32);

                    oci_execute($stmt);

                    echo "<tr style='text-align: center;'>";
                    echo "<td>" . $ostatni_tydzien . " zł</td>";
                    echo "<td>" . $ostatni_miesiac . " zł</td>";
                    echo "<td>" . $ostatni_kwartal . " zł</td>";
                    echo "</tr>";


                    oci_free_statement($stmt);
                    oci_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>