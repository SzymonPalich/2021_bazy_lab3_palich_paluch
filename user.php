<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Sharp|Material+Icons+Round|Material+Icons+Two+Tone" />

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>

    <link href="css/login-register.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/user.css" rel="stylesheet" />
    <script src="js/user.js"></script>

    <style>
        #placeholder {
            width: 288px;
            height: 162px;
        }

        #footer {
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>


    <script>
        $(document).ready(function() {
            $("#home").click(function() {
                loadUserData('userHome');
            });
            $("#bookings").click(function() {
                loadUserData('userBookings');
            });
            $("#paid").click(function() {
                loadUserData('userFlights');
            });
            $("#profile").click(function() {
                loadUserData('userProfile');
            })
        });
    </script>
</head>

<body>
<?php 
include "phpScripts/config.php";
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
                            <li><a class="dropdown-item" id="home" href="#">Home</a></li>
                            <li><a class="dropdown-item" id="bookings" href="#">Bookings</a></li>
                            <li><a class="dropdown-item" id="paid" href="#">Flights</a></li>
                            <li><a class="dropdown-item" id="profile" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="phpScripts/logout.php">Sign Out</a></li>
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
                include "prefab/userHome.php";
                ?>
            </main>

        </div>
    </div>
    <?php
    include "prefab/footer";
    ?>
</body>

</html>