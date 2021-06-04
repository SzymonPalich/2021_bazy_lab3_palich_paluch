<?php


include "config2.php";
$id = $_REQUEST["el"];
$curs = oci_new_cursor($conn);
$stid = oci_parse($conn, "begin get_data_for_pdf(:cursbv,'$id'); end;");
oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
oci_execute($stid);

oci_execute($curs);

$row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS);

$id_bilet = $row['ID_BILET'];
$imie = $row['IMIE'];
$nazwisko = $row['NAZWISKO'];
$cena = $row['CENA'];
$miejsce = $row['MIEJSCE'];
$miejsce_odlotu = $row['MIEJSCE_ODLOTU'];
$miejsce_przylotu = $row['MIEJSCE_PRZYLOTU'];
$data_odlotu = $row['DATA_ODLOTU'];
$typ_bagazu = $row['TYP'];

oci_free_statement($stid);
oci_free_statement($curs);
oci_close($conn);










require_once('../library1/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('dejavusans', '', 16);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->AddPage();
$html = '


    <html>

    <head>
        <meta charset="utf-8">
    </head>
    
    <style>
        body {
            color: #2a052a;
        }
    
        table {
            width: 90%;
            margin: auto;
        }
    
        td {
            height: 50px;
        }
    
        .left {
            float: left;
            width: 50%;
        }
    
        .right {
            float: left;
            width: 50%;
            text-align: right;
        }
    
        .tab-left {
            border-left: 1.25px solid #2a052a;
            border-top: 1.25px solid #2a052a;
            border-bottom: 1.25px solid #2a052a;
            background-color: #eba2eb;
            font-weight: bolder;
            
        }
    
        .tab-right {
            border-right: 1.25px solid #2a052a;
            border-top: 1.25px solid #2a052a;
            border-bottom: 1.25px solid #2a052a;
            background-color: #ffe1ff;
    
        }
    
        .header {
            width: 90%;
            margin: auto;
        }
    
    </style>
    
    <body>
        <div class="header">
            <p class="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biled Lotniczy &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                  #' . $id_bilet . '</b></p>
        </div>
        <br>
    
        <table class="usluga">
            <tr>
                <td class="tab-left">Imię</td>
                <td class="tab-right">' . $imie . '</td>
            </tr>
            <tr>
                <td class="tab-left">Nazwisko</td>
                <td class="tab-right">' . $nazwisko . '</td>
            </tr>
            <tr>
                <td class="tab-left">Cena</td>
                <td class="tab-right">' . $cena . ' zł</td>
            </tr>
            <tr>
                <td class="tab-left">Miejsce</td>
                <td class="tab-right">' . $miejsce . '</td>
            </tr>
            <tr>
            <td class="blank"></td>
            <td class="blank"></td>
        </tr>

            <tr>
                <td class="tab-left">Miejsce odlotu</td>
                <td class="tab-right">' . $miejsce_odlotu . '</td>
            </tr>
            <tr>
                <td class="tab-left">Miejsce docelowe</td>
                <td class="tab-right">' . $miejsce_przylotu . '</td>
            </tr>
            <tr>
                <td class="tab-left">Data odlotu</td>
                <td class="tab-right">' . $data_odlotu . '</td>
            </tr>
            <tr>
                <td class="tab-left">Bagaż</td>
                <td class="tab-right">' . $typ_bagazu . '</td>
            </tr>
        </table>

        <br><br><br><br><br><br><br><br>
    
        <div class="header">
        <p class="left"><b>WruumAir&trade;&copy;&reg;2021 Palich & Paluch USA.</b></p>
    </div>
    </html>

    ';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Image('../img/biled.png', 138, 237, 80);
$pdf->Output();
