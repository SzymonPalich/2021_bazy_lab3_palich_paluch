<!doctype html>
<html>

<?php
session_start();
$success = include "./phpScripts/config2.php";

$curs = oci_new_cursor($conn);
$stid = oci_parse($conn, "begin ZBLIZAJACE_SIE_LOTY(:cursbv,'" . $_SESSION['username'] . "'); end;");
oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
oci_execute($stid);

oci_execute($curs);
$i = 0;

while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    $data_odlotu = $row['DATA_ODLOTU'];
    $timestamp = DateTime::createFromFormat('d-m-y H:i', $data_odlotu);
    $tajmu = $timestamp->getTimestamp();
    $tajmu *= 1000;



    echo '    
    <script>
    function timer'.$i.'() {
        var countDownDate = '.$tajmu.';

        var x = setInterval(function() {

            var now = new Date().getTime();

            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer" + '.$i.').innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";
                
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer" + '.$i.').innerHTML = "EXPIRED";
            }
        }, 1000);
    }
    </script>';












    $i++;
}


oci_free_statement($stid);
oci_free_statement($curs);
oci_close($conn);





?>





<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Sharp|Material+Icons+Round|Material+Icons+Two+Tone" />

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="css/new.css" />
    <script src="bootstrap/js/bootstrap.js"></script>

    <link href="css/login-register.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/user.css" rel="stylesheet" />
    <script src="js/user.js"></script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>








    <style>
        .nic {
            height: 270px;
            font-size: large;
        }


        .lot-heading {
            font-size: 30px;
            margin: auto;
            color: #2a052a;
        }

        .lot-border {
            /* border-color: #ffffff;
            border-style: dashed;
            border-radius: 8px; */
            height: 316px;
            padding-top: 1px;
            padding-bottom: 13px;
        }

        .xd {
            padding-top: 8px !important;
        }

        #placeholder {
            width: 288px;
            height: 162px;
        }
    </style>


    <script>
        $(document).ready(function() {
            $("#home").click(function() {
                loadUserData('userProfile');
            });
            $("#bookings").click(function() {
                loadUserData('userBookings');
            });
            $("#paid").click(function() {
                loadUserData('userFlights');
            });
            $("#profile").click(function() {
                loadUserData('userHome');
            })
        });
    </script>
</head>

<body>
    <?php
    include "phpScripts/config2.php";
    if (!isset($_SESSION['username']) || $_SESSION['typ_konta'] != 0) {
        header('Location: index.php');
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bd-navbar shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">WruumAir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-sm-inline mx-1">
                                <?php
                                echo 'Witaj, ' . ucfirst($_SESSION['username']);
                                ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow w-100" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" id="home" href="#">Profil</a></li>
                            <li><a class="dropdown-item" id="bookings" href="#">Rezerwacje</a></li>
                            <li><a class="dropdown-item" id="paid" href="#">Bilety</a></li>
                            <li><a class="dropdown-item" id="profile" href="#">Loty</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="phpScripts/logout.php">Wyloguj</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <main id="userMain">
                <?php
                include "prefab/userProfile.php";
                ?>
            </main>

        </div>
    </div>
</body>


</html>