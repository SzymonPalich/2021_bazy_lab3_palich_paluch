<?php
session_start();

const max_rows = 23;

function getListUzytkownicy($page, $search)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin uzytkownicy_diu.get_from_table(:cursbv, " . (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .  " , '". $search ."'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID_UZYTKOWNIK'] . "</td>";
        echo "<td>" . $row['USERNAME'] . "</td>";
        if($row['TYP_KONTA'] == 1){
            echo "<td>Administrator</td>";
        }
        else {
            echo "<td>Użytkownik</td>";
        }
        echo "<td>&nbsp;&nbsp;&nbsp;<a data-bs-toggle='modal' data-bs-target='#edytujModal' onclick=setId(" . $row['ID_UZYTKOWNIK'] . ",'#userid_edit') href='#'><img src='./img/icons/edit.png'></a></td>";
        echo "<td>&nbsp;&nbsp;<a onclick=\"deleteUser(" . $row['ID_UZYTKOWNIK'] . ", " . $page . ")\" href=\"#\"><img src='./img/icons/remove.png'></a></td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getNumberOfUzytkownicy()
{
    include "config2.php";

    $sql = "begin uzytkownicy_diu.get_number_of_rows(:wyjscie); end;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':wyjscie', $wyjscie, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $wyjscie;
}

function makeBagintionUzytkownicy($active)
{
    $l_col = getNumberOfUzytkownicy();
    for ($i = 1; $i <= ceil($l_col / max_rows); $i++) {
        if ($i == $active)
            echo '<li class="page-item active"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'uzytkownicy\')" href="#">' . $i . '</a></li>';
        else
            echo '<li class="page-item"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'uzytkownicy\')" href="#">' . $i . '</a></li>';
    }
}

function getListSamoloty($page, $search)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin samoloty_diu.get_from_table(:cursbv, " . (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .  " , '". $search ."'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID_SAMOLOT'] . "</td>";
        echo "<td>" . $row['TYP'] . "</td>";
        echo "<td>" . $row['MARKA'] . "</td>";
        echo "<td>" . $row['S_MODEL'] . "</td>";
        echo "<td>" . $row['LICZBA_MIEJSC'] . "</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;<a data-bs-toggle='modal' data-bs-target='#edytujModal' onclick=setId(" . $row['ID_SAMOLOT'] . ",'#samolotid_edit') href='#'><img src='./img/icons/edit.png'></a></td>";
        echo "<td>&nbsp;&nbsp;<a onclick=\"deleteSamolot(" . $row['ID_SAMOLOT'] . ", " . $page . ")\" href=\"#\"><img src='./img/icons/remove.png'></a></td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getNumberOfSamoloty()
{
    include "config2.php";

    $sql = "begin samoloty_diu.get_number_of_rows(:wyjscie); end;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':wyjscie', $wyjscie, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $wyjscie;
}

function makeBagintionSamoloty($active)
{
    $l_col = getNumberOfSamoloty();
    for ($i = 1; $i < ceil($l_col / max_rows); $i++) {
        if ($i == $active)
            echo '<li class="page-item active"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'samoloty\')" href="#">' . $i . '</a></li>';
        else
            echo '<li class="page-item"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'samoloty\')" href="#">' . $i . '</a></li>';
    }
}

function samolotyGetTyp($type)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin samoloty_diu.get_typ(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    if ($type == "ADD") {
        echo '<select class="form-control" id="typ">';
    }
    else {
        echo '<select class="form-control" id="typ_edit">';
        echo '<option></option>';
    }
    
    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo '<option>' . $row['ID_TYP'] . ' - ' . $row['TYP'] . '</option>';
        echo "</tr>";
    }
    echo '</select>';
    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getListPracownicy($page, $search)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin pracownicy_diu.get_from_table(:cursbv, " . (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .  " , '". $search ."'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID_PRACOWNIK'] . "</td>";
        echo "<td>" . $row['IMIE'] . "</td>";
        echo "<td>" . $row['NAZWISKO'] . "</td>";
        echo "<td>" . $row['STANOWISKO'] . "</td>";
        echo "<td>" . $row['PENSJA'] . "</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;<a data-bs-toggle='modal' data-bs-target='#edytujModal' onclick=setId(" . $row['ID_PRACOWNIK'] . ",'#pracownikid_edit') href='#'><img src='./img/icons/edit.png'></a></td>";
        echo "<td>&nbsp;&nbsp;<a onclick=\"deletePracownik(" . $row['ID_PRACOWNIK'] . ", " . $page . ")\" href=\"#\"><img src='./img/icons/remove.png'></a></td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getNumberOfPracownicy()
{
    include "config2.php";

    $sql = "begin pracownicy_diu.get_number_of_rows(:wyjscie); end;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':wyjscie', $wyjscie, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $wyjscie;
}

function makeBaginationPracownicy($active)
{
    $l_col = getNumberOfPracownicy();
    for ($i = 1; $i <= ceil($l_col / max_rows); $i++) {
        if ($i == $active)
            echo '<li class="page-item active"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'pracownicy\')" href="#">' . $i . '</a></li>';
        else
            echo '<li class="page-item"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'pracownicy\')" href="#">' . $i . '</a></li>';
    }
}

function getListLotniska($page, $search)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin lotniska_diu.get_from_table(:cursbv, " . (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .  " , '". $search ."'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID_LOTNISKO'] . "</td>";
        echo "<td>" . $row['KOD_LOTNISKO'] . "</td>";
        echo "<td>" . $row['MIASTO'] . "</td>";
        echo "<td>" . $row['KRAJ'] . "</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;<a data-bs-toggle='modal' data-bs-target='#edytujModal' onclick=setId(" . $row['ID_LOTNISKO'] . ",'#lotniskoid_edit') href='#'><img src='./img/icons/edit.png'></a></td>";
        echo "<td>&nbsp;&nbsp;<a onclick=\"deleteLotnisko(" . $row['ID_LOTNISKO'] . ", " . $page . ")\" href=\"#\"><img src='./img/icons/remove.png'></a></td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getNumberOfLotniska()
{
    include "config2.php";

    $sql = "begin lotniska_diu.get_number_of_rows(:wyjscie); end;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':wyjscie', $wyjscie, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $wyjscie;
}

function makeBagintionLotniska($active)
{
    $l_col = getNumberOfLotniska();
    for ($i = 1; $i <= ceil($l_col / max_rows); $i++) {
        if ($i == $active)
            echo '<li class="page-item active"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'lotniska\')" href="#">' . $i . '</a></li>';
        else
            echo '<li class="page-item"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'lotniska\')" href="#">' . $i . '</a></li>';
    }
}

function getListBagaze($page, $search)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin bagaze_diu.get_from_table(:cursbv, " . (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .  " , '". $search ."'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID_BAGAZ'] . "</td>";
        echo "<td>" . $row['TYP'] . "</td>";
        echo "<td>" . $row['WAGA_BAGAZU_PODRECZNEGO'] . "</td>";
        echo "<td>" . $row['WAGA_BAGAZU_REJESTROWANEGO'] . "</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;<a data-bs-toggle='modal' data-bs-target='#edytujModal' onclick=setId(" . $row['ID_BAGAZ'] . ",'#bagazid_edit') href='#'><img src='./img/icons/edit.png'></a></td>";
        echo "<td>&nbsp;&nbsp;<a onclick=\"deleteBagaze(" . $row['ID_BAGAZ'] . ", " . $page . ")\" href=\"#\"><img src='./img/icons/remove.png'></a></td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getNumberOfBagaze()
{
    include "config2.php";

    $sql = "begin bagaze_diu.get_number_of_rows(:wyjscie); end;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':wyjscie', $wyjscie, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $wyjscie;
}

function makeBagintionBagaze($active)
{
    $l_col = getNumberOfBagaze();
    for ($i = 1; $i <= ceil($l_col / max_rows); $i++) {
        if ($i == $active)
            echo '<li class="page-item active"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'bagaze\')" href="#">' . $i . '</a></li>';
        else
            echo '<li class="page-item"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'bagaze\')" href="#">' . $i . '</a></li>';
    }
}


function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}


function getListLoty($page, $search)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin loty_diu.get_from_table(:cursbv, " . (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .  " , '". $search ."'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID_LOT'] . "</td>";
        echo "<td>" . $row['MIEJSCE_ODLOTU'] . "</td>";
        echo "<td>" . $row['MIEJSCE_PRZYLOTU'] . "</td>";
        echo "<td>" . $row['NAZWA_SAMOLOTU'] . "</td>";
        echo "<td>" . $row['DATA_ODLOTU'] . "</td>";
        echo "<td>" . $row['DATA_PRZYLOTU'] . "</td>";
        echo "<td>" . convertToHoursMins($row['PRZEWIDYWANY_CZAS_LOTU']) . "</td>";
        echo "<td>" . $row['WAGA_BAGAZY'] . " kg" . "</td>";
        echo "<td>" . $row['PRZEWIDYWANY_ZYSK'] . " zł" . "</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;<a data-bs-toggle='modal' data-bs-target='#edytujModal' onclick=setId(" . $row['ID_LOT'] . ",'#lotid_edit');fixEditDate(); href='#'><img src='./img/icons/edit.png'></a></td>";
        echo "<td>&nbsp;&nbsp;<a onclick=\"deleteLot(" . $row['ID_LOT'] . ", " . $page . ")\" href=\"#\"><img src='./img/icons/remove.png'></a></td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getNumberOfLoty()
{
    include "config2.php";

    $sql = "begin loty_diu.get_number_of_rows(:wyjscie); end;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':wyjscie', $wyjscie, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $wyjscie;
}

function makeBagintionLoty($active)
{
    $l_col = getNumberOfLoty();
    for ($i = 1; $i <= ceil($l_col / max_rows); $i++) {
        if ($i == $active)
            echo '<li class="page-item active"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'loty\')" href="#">' . $i . '</a></li>';
        else
            echo '<li class="page-item"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'loty\')" href="#">' . $i . '</a></li>';
    }
}

function lotyGetPrzylot($type)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin loty_diu.get_lotnisko(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    if ($type == "ADD") {
        echo '<select class="form-control" id="m_przylotu">';
        echo '<option></option>';
    }
    else {
        echo '<select class="form-control" id="m_przylotu_edit">';
        echo '<option></option>';
    }
    
    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo '<option>' . $row['ID_LOTNISKO'] . ' - ' . $row['KOD_LOTNISKO'] . '</option>';
        echo "</tr>";
    }
    echo '</select>';
    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function lotyGetOdlot($type)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin loty_diu.get_lotnisko(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    if ($type == "ADD") {
        echo '<select class="form-control" id="m_odlotu">';
        echo '<option></option>';
    }
    else {
        echo '<select class="form-control" id="m_odlotu_edit">';
        echo '<option></option>';
    }
    
    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo '<option>' . $row['ID_LOTNISKO'] . ' - ' . $row['KOD_LOTNISKO'] . '</option>';
        echo "</tr>";
    }
    echo '</select>';
    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}



function lotyGetSamolot($type)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin loty_diu.get_samolot(:cursbv); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);

    if ($type == "ADD") {
        echo '<select class="form-control" id="samolot">';
    }
    else {
        echo '<select class="form-control" id="samolot_edit">';
        echo '<option></option>';
    }
    
    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo '<option>' . $row['ID_SAMOLOT'] . ' - ' . $row['S_MODEL'] . '</option>';
        echo "</tr>";
    }
    echo '</select>';
    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getListBilety($page, $search)
{
    include "config2.php";
    $curs = oci_new_cursor($conn);
    $stid = oci_parse($conn, "begin bilety_diu.get_from_table(:cursbv, " . (($page * max_rows - max_rows) + 1) . ", " . ($page * max_rows) .  " , '". $search ."'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);

    oci_execute($curs);


    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        echo "<tr>";
        echo "<td>" . $row['ID_BILET'] . "</td>";
        echo "<td title='".$row['PASAZER']."'>" . $row['ID_PASAZER'] . "</td>";
        echo "<td title='".$row['LOT']."'>" . $row['ID_LOT'] . "</td>";
        echo "<td title='".$row['BAGAZ']."'>" . $row['ID_BAGAZ'] . "</td>";
        echo "<td>" . $row['MIEJSCE'] . "</td>";
        echo "<td>" . $row['CENA'] . "</td>";
        echo "<td>" . ($row['CZY_OPLACONY'] ? "Tak" : "Nie") . "</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;<a data-bs-toggle='modal' data-bs-target='#edytujModal' onclick=setId(" . $row['ID_BILET'] . ",'#biletid_edit') href='#'><img src='./img/icons/edit.png'></a></td>";
        echo "<td>&nbsp;&nbsp;<a onclick=\"deleteBilet(" . $row['ID_BILET'] . ", " . $page . ")\" href=\"#\"><img src='./img/icons/remove.png'></a></td>";
        echo "</tr>";
    }

    oci_free_statement($stid);
    oci_free_statement($curs);
    oci_close($conn);
}

function getNumberOfBilety()
{
    include "config2.php";

    $sql = "begin bilety_diu.get_number_of_rows(:wyjscie); end;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':wyjscie', $wyjscie, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $wyjscie;
}

function makeBagintionBilety($active)
{
    $l_col = getNumberOfBilety();
    for ($i = 1; $i <= ceil($l_col / max_rows); $i++) {
        if ($i == $active)
            echo '<li class="page-item active"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'bilety\')" href="#">' . $i . '</a></li>';
        else
            echo '<li class="page-item"><a class="page-link" onclick="loadTableContent( ' . $i . ', \'bilety\')" href="#">' . $i . '</a></li>';
    }
}