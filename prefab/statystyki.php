<?php
function getBestBagaze()
{
    include "phpScripts/config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin statystyka_opisowa.najczesciej_wybierane_bagaze(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo ',["' . $row['TYP'] . '",' . $row['LICZBA'] . ']';
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getBestMiejsca()
{
    include "phpScripts/config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin statystyka_opisowa.najczesciej_wybierane_miejsca(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo ',["' . $row['MIEJSCE'] . '",' . $row['LICZBA'] . ']';
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function Top_5_klientow()
{
    include "phpScripts/config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin statystyka_opisowa.top_5_klientow(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo ',["' . $row['NAZWISKO'] . ' ' . $row['IMIE'] . '",' . $row['CENA'] . ']';
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}




function getPracownicyZarobki()
{
    include "phpScripts/config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin statystyka_opisowa.pracownicy_zarobki(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo ',["' . $row['PENSJA'] . '",' . $row['N'] . ']';
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}




//getBestBagaze();
//getBestMiejsca();
// getPracownicyZarobki();
// Top_5_klientow();
// ostatnie_zarobki();
