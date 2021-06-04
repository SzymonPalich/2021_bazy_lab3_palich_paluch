<html>

<head>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="css/dashboard.css" rel="stylesheet">

    <script src="js/dashboard.js"></script>
    <link href="css/login-register.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />

    <script src="js/login-register.js" type="text/javascript"></script>
    <script src="js/jquery.passtrength.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <?php
    include 'prefab/header.php';
    include 'phpScripts/config2.php';
    $id_lot = $_REQUEST["id"];
    $curs = oci_new_cursor($conn);
    $username = $_SESSION['username'];
    $page = "userProfile";
    $stid = oci_parse($conn, "begin user_profile.user_find(:cursbv,'" . $username . "'); end;");
    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
    oci_execute($stid);
    oci_execute($curs);
    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
        $name = $row['IMIE'];
        $surname = $row['NAZWISKO'];
        $e_mail = $row['E_MAIL'];
        $number = $row['NR_TELEFONU'];
    }

    oci_free_statement($stid);
    oci_free_statement($curs);


    $sql = "begin get_cena_biletu('". $id_lot ."', :cena_biletu); end;";
    

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':cena_biletu', $cena_biletu, 32);

    oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    ?>

    <style>
        .center-data {
            margin: auto;
            padding: 15px;
            margin-bottom: 55px;
            width: 60%;
            height: 50%;
        }

        .form-control[readonly] {
            color: #f8f8f8;
            font-weight: 500;
            background-color: #ff99ff;
        }
    </style>

    <script>
        var cena_biletu = <?php echo $cena_biletu?>;
        $(document).ready(function() {
            $('#bag_rej').change(function() {
                if ($('#bag_rej').val() < 1)
                {
                    $('#typ_bagazu').val("Brak bagazu rejestrowanego");
                    $('#cena').val(cena_biletu);
                }
                else if ($('#bag_rej').val() < 10)
                {
                    $('#typ_bagazu').val("Mini (+ 55 zl)");
                    $('#cena').val(cena_biletu + 55);
                }
                else if ($('#bag_rej').val() < 20)
                {
                    $('#typ_bagazu').val("Midi (+ 80 zl)");
                    $('#cena').val(cena_biletu + 80);
                }
                else
                {
                    $('#typ_bagazu').val("Maxi (+ 280 zl)");
                    $('#cena').val(cena_biletu + 280);
                }
            });
        });
    </script>


</head>

<body>
    <br>
    <div class="center-data">
        <form method="post" action="rezerwacja.php?id=<?php echo $id_lot; ?>">
            <div class="mb-3">
                <label class="form-label">Imie</label>
                <input type="text" readonly class="form-control dis" name="name" id="name" value="<?php echo ucfirst($name) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nazwisko</label>
                <input type="text" readonly class="form-control" name="surname" id="surname" value="<?php echo ucfirst($surname) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">E-Mail</label>
                <input type="text" readonly class="form-control" name="e_mail" id="e_mail" value="<?php echo $e_mail ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Numer tel.</label>
                <input type="text" readonly class="form-control" name="number" id="number" value="<?php echo $number ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Typ bagażu</label>
                <input type="text" readonly class="form-control" name="typ_bagazu" id="typ_bagazu" value="Brak bagazu rejestrowanego">
            </div>
            <div class="mb-3">
                <label class="form-label">Cena</label>
                <input type="text" readonly class="form-control" name="cena" id="cena" value="<?php echo $cena_biletu ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Waga bagazu podręcznego</label>
                <input class="form-control" type="number" name="bag_podr" id="bag_podr" min="0" max="12">
            </div>
            <div class="mb-3">
                <label class="form-label">Waga bagażu resjestrowanego</label>
                <input class="form-control" type="number" name="bag_rej" id="bag_rej" min="0" max="35">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" onclick="location.href='index.php'">Anuluj</button>
                <button type="submit" class="btn btn-primary">Zarezerwuj :3</button>
            </div>
        </form>
    </div>
</body>

</html>