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
  <script>
    function validateInput(){
    var a = $('#kraj_odlotu').val().trim();
    var b = $('#miasto_odlotu').val().trim();
    var c = $('#kraj_przylotu').val().trim();
    var d = $('#miasto_przylotu').val().trim();
    if(a == "" && b == "" && c == "" && d == ""){
        alert('Uzupelnij przynajmniej jedno pole');
        return false;
    }
  }
  </script>

</head>



<?php
include 'prefab/header.php';

function convertToHoursMins($time, $format = '%02d:%02d')
{
  if ($time < 1) {
    return;
  }
  $hours = floor($time / 60);
  $minutes = ($time % 60);
  return sprintf($format, $hours, $minutes);
}


function makeTable()
{
  include "phpScripts/config2.php";
  $curs = oci_new_cursor($conn);
  $kraj_odlotu = strtoupper(trim($_POST['kraj_odlotu']));
  $miasto_odlotu = strtoupper(trim($_POST['miasto_odlotu']));
  $kraj_przylotu = strtoupper(trim($_POST['kraj_przylotu']));
  $miasto_przylotu = strtoupper(trim($_POST['miasto_przylotu']));
  $stid = oci_parse($conn, "begin find_flight(:cursbv, '" . $kraj_odlotu . "', '" . $miasto_odlotu . "', '" . $kraj_przylotu . "', '" . $miasto_przylotu .  "'); end;");
  oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
  oci_execute($stid);

  oci_execute($curs);
  $git_gut = false;

  while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    if  (date($row['DATA_ODLOTU']) > date("d-m-y h:i")) {
      $git_gut = true;
      echo "<tr>";
      echo "<td>" . $row['KRAJ_ODLOTU'] . ", " . $row['MIASTO_ODLOTU'] . "</td>";
      echo "<td>" . $row['KRAJ_PRZYLOTU'] . ", " . $row['MIASTO_PRZYLOTU'] . "</td>";
      echo "<td>" . $row['DATA_ODLOTU'] . "</td>";
      echo "<td>" . $row['DATA_PRZYLOTU'] . "</td>";
      echo "<td>" . convertToHoursMins($row['PRZEWIDYWANY_CZAS_LOTU']) . "</td>";
      echo "<td>" . $row['CENA_BILETU'] . " zł" . "</td>";
      if (isset($_SESSION['username'])) {
        echo "<td><a class='btn btn-primary' href='test10.php?id=" . $row['ID_LOT'] . "'>Zarezerwuj</button></td>";
      }
      else {
        echo "<td>" . "Lepiej się Zaloguj :) ". "</td>";
      }
      echo "</tr>";
    }
  }
  if (!$git_gut) {
    echo "<tr>";
    echo "<td>" . "BRAK" . "</td>";
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



?>

<body>

  <!-- Search -->
  <div class="sercz2">
    <div id="sercznaserchu2" class="card card-5">
      <div class="card-body">
        <form method="POST" onsubmit="return validateInput()">
          <?php
          include 'phpScripts/indexUtils.php';
          ?>
          <div class="active-purple-3 active-purple-4 mb-3">
            <datalist id="lista_miast">
              <?php
              get_Miasta();
              ?>
            </datalist>
            <datalist id="lista_krajow">
              <?php
              get_Kraje();
              ?>
            </datalist>

            <input list="lista_krajow" name="kraj_odlotu" id="kraj_odlotu" class="form-control mb-4 col-3 search-field-left" type="text" placeholder="Podaj kraj..." aria-label="Search" />
            <input list="lista_miast" name="miasto_odlotu" id="miasto_odlotu" class="form-control mb-4 col-3 search-field-right" type="text" placeholder="...bądź miasto odlotu." aria-label="Search" />
            <br><br>
            <input list="lista_krajow" name="kraj_przylotu" id="kraj_przylotu" class="form-control mb-4 search-field-left" type="text" placeholder="Podaj kraj..." aria-label="Search" />
            <input list="lista_miast" name="miasto_przylotu" id="miasto_przylotu" class="form-control mb-4 search-field-right" type="text" placeholder="...bądź miasto docelowe." aria-label="Search" />
            <br><br><br>
            <input type="submit" href="#" class="search-button" value="Szukaj!" />
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="modal fade login" id="loginModal">
      <div class="modal-dialog login animated">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Logowanie</h4>
          </div>
          <div class="modal-body">
            <div class="box">
              <div class="content">
                <div class="error"></div>
                <div class="form loginBox">
                  <form method="POST" action="" accept-charset="UTF-8">
                    <input id="username" class="form-control" type="text" placeholder="Nazwa użytkownika" name="username" autocomplete="off">
                    <input id="password" class="form-control" type="password" placeholder="Hasło" name="password" autocomplete="off">
                    <input class="btn btn-default btn-login" type="button" value="Zaloguj" onclick="login()">
                  </form>
                </div>
              </div>
            </div>
            <div class="box">
              <div class="content registerBox" style="display:none;">
                <div class="form">
                  <form method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                    <input id="username2" class="form-control" type="text" placeholder="Nazwa użytkownika" name="email" autocomplete="off" />
                    <input id="password2" class="form-control" type="password" placeholder="Hasło" name="password" autocomplete="off" />
                    <input id="password_confirmation" class="form-control" type="password" placeholder="Powtórz hasło" name="password_confirmation" autocomplete="off" />
                    <input class="btn btn-default btn-register" type="button" value="Zarejestruj" name="commit" onclick="register()">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="forgot login-footer">
             <span>Czy chcesz <a class="show_new" href="javascript: showRegisterForm();">stworzyć konto</a>?</span>
            </div>
            <div class="forgot register-footer" style="display:none">
              <span>Juz posiadasz konto?</span>
              <a class="show_new" href="javascript: showLoginForm();">Zaloguj</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>Miejsce odlotu</th>
          <th>Miejsce przylotu</th>
          <th>Data odlotu</th>
          <th>Data przylotu</th>
          <th>Czas lotu</th>
          <th>Cena od</th>
          <th>Zarezerwuj</th>
        </tr>
      </thead>
      <tbody>
        <?php
        makeTable();
        ?>
      </tbody>
    </table>


</body>