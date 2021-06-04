<!DOCTYPE html>
<html lang="en">

<head>
  <title>Lotnisko</title>
  <meta charset="utf-8">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <l src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></l>
    <l src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></l> -->

  <link rel="stylesheet" href="css/new.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Sharp|Material+Icons+Round|Material+Icons+Two+Tone" />
  <link rel="stylesheet" href="css/passtrength.css" />
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>




  <style>
    .active-pink-4 input[type=text]:focus:not([readonly]) {
      border: 1px solid #f48fb1;
      box-shadow: 0 0 0 1px #f48fb1;
    }

    .active-pink-3 input[type=text] {
      border: 1px solid #f48fb1;
      box-shadow: 0 0 0 1px #f48fb1;
    }

    .active-purple-4 input[type=text]:focus:not([readonly]) {
      border: 1px solid #ce93d8;
      box-shadow: 0 0 0 1px #ce93d8;
    }

    .active-purple-3 input[type=text] {
      border: 1px solid #ce93d8;
      box-shadow: 0 0 0 1px #ce93d8;
    }
  </style>


  <link href="css/login-register.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />

  <script src="js/login-register.js" type="text/javascript"></script>
  <script src="js/jquery.passtrength.js"></script>
  <script>
    $(document).ready(function($) {
      $('#password2').passtrength({
        minChars: 4,
        tooltip: true
      });
    });

    function validateInput() {
      var a = $('#kraj_odlotu').val().trim();
      var b = $('#miasto_odlotu').val().trim();
      var c = $('#kraj_przylotu').val().trim();
      var d = $('#miasto_przylotu').val().trim();
      if (a == "" && b == "" && c == "" && d == "") {
        alert('Uzupelnij przynajmniej jedno pole');
        return false;
      }
    }
  </script>

</head>

<body>
  <?php
  include "prefab/header.php";
  ?>


  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <img src="img/kyoto.png" class="d-block w-100" alt="Kyoto">
        <div class="carousel-caption d-none d-md-block">
          <h5>Kyoto</h5>
          <p>Kyoto zachowuje wiekszosc swojego historycznego uroku i piekna w swoich licznych swiatyniach i kapliczkach.</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img src="img/dover.png" class="d-block w-100" alt="Dover">
        <div class="carousel-caption d-none d-md-block">
          <h5>Dover</h5>
          <p>Slynie z białych kredowych klifow, którym Anglia zawdziecza swoja poetycką nazwe "Albion".</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/cair.png" class="d-block w-100" alt="Cairo">
        <div class="carousel-caption d-none d-md-block">
          <h5>Cairo</h5>
          <p>„Miasto umarłych” to potezna nekropolia, gdzie zywi ludzie mieszkaja razem ze zmarlymi w murowanych grobowcach. </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/bangkog.png" class="d-block w-100" alt="Bangkok">
        <div class="carousel-caption d-none d-md-block">
          <h5>Bangkok</h5>
          <p>Bangkok moze być nazwany „miastem swiatyn” z powodu obecnosci swiatyn buddyjskich na niemal kazdej ulicy. </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/telatyn.jpg" class="d-block w-100" alt="Telatyn">
        <div class="carousel-caption d-none d-md-block">
          <h5>Telatyn</h5>
          <p>W wyborach parlamentarnych w 2007 w gminie Telatyn padl rekord poparcia dla PSL.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <br>
  <!-- Search -->
  <div class="sercz">
    <div id="sercznaserchu" class="card card-5">
      <div class="card-body">
        <form method="POST" action="search.php" onsubmit="return validateInput()">
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

  <!-- Flights -->
  <div id="new" class="container">
    <div class="row">
      <?php
      function upcomingFlights()
      {
        include "phpScripts/config2.php";
        $curs = oci_new_cursor($conn);;
        $stid = oci_parse($conn, "begin upcoming_flights(:cursbv); end;");
        oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
        oci_execute($stid);

        oci_execute($curs);
        $git_gut = 0;

        while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
          $git_gut++;
          $kod_odlotu = $row['KOD_ODLOTU'];
          $miasto_odlotu = $row['MIASTO_ODLOTU'];
          $kod_przylotu = $row['KOD_PRZYLOTU'];
          $miasto_przylotu = $row['MIASTO_PRZYLOTU'];
          $data_odlotu = $row['DATA_ODLOTU'];
          $data_przylotu = $row['DATA_PRZYLOTU'];
          $cena = $row['CENA_BILETU'];
          $id_lot = $row['ID_LOT'];
          makeCard($kod_odlotu, $miasto_odlotu, $kod_przylotu, $miasto_przylotu, $data_odlotu, $data_przylotu, $cena, $id_lot);
        }
        while ($git_gut < 3) {
          echo '<div class="col-sm-6 col-md-4 col-xs-12">';
          echo '
            <article class="card card-big mb15">
              <div class="card_img-wrap">
                <img src="img/telatyn.jpg">
                <h4 class="title title-overlay-center">Telatyn</h4>
              </div>
              <div class="card_info">
                <div class="title-left-wrap">
                  <h5>Telatyn</h5> <small> TEL </small>
                </div>
                <span class="icon-center-wrap"><i class="material-icons rotate90"></i></span>
                <div class="title-right-wrap">
                  <h5>Korea</h5> <small> KOR </small>
                </div>
              </div>
              <div class="card_pricelist">
                <div class="cost">
                  <div class="logo-wrap"><img src="placeholder.gif"></div>
                  <div class="icon-wrap"> <i class="material-icons">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small> </div>
                  <div class="price-wrap"><var class="price"><span class="currency"><b>Cena od</b></span></var></div>
                  <div class="price-wrap"><var class="price"><span class="currency">PLN</span> 120.14</var></div>
                </div>
              </div>
            </article>';

          echo '
          </div>';
          $git_gut++;
        }


        oci_free_statement($stid);
        oci_free_statement($curs);
        oci_close($conn);
      }

      function makeCard($kod_odlotu, $miasto_odlotu, $kod_przylotu, $miasto_przylotu, $data_odlotu, $data_przylotu, $cena, $id_lot)
      {
        $photo = 'photos/' . strtolower($miasto_przylotu) . '.png';
        if (!file_exists($photo)) {
          $photo = 'photos/placeholder.png';
        }
        echo '<div class="col-sm-6 col-md-4 col-xs-12">';
        if ((isset($_SESSION['username'])))
          echo '<a href="test10.php?id=' . $id_lot . '">';
        echo '<article class="card card-big mb15">
          <div class="card_img-wrap">
            <img src="' . $photo . '">
            <h4 class="title title-overlay-center">' . $miasto_przylotu . '</h4>
          </div>
          <div class="card_info">
            <div class="title-left-wrap">
              <h5>' . $miasto_odlotu . '</h5> <small> ' . $data_odlotu . ' </small>
            </div>
            <span class="icon-center-wrap"><i class="material-icons rotate90"></i></span>
            <div class="title-right-wrap">
              <h5>' . $miasto_przylotu . '</h5> <small>' . $data_przylotu . '</small>
            </div>
          </div>
          <div class="card_pricelist">
            <div class="cost">
              <div class="logo-wrap"><img src="placeholder.gif"></div>
              <div class="icon-wrap"> <i class="material-icons">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small> </div>
              <div class="price-wrap"><var class="price"><span class="currency"><b>Cena od</b></span></var></div>
              <div class="price-wrap"><var class="price"><span class="currency">PLN </span>' . $cena . '</var></div>
            </div>
          </div>
        </article>';
        if ((isset($_SESSION['username']))) echo '</a>';
        echo '
      </div>';
      }
      upcomingFlights();
      ?>

    </div>
  </div>

  <!-- Login and register form -->
  <div class="container">
    <div class="modal fade login" id="loginModal">
      <div class="modal-dialog login animated">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Zaloguj</h4>
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

  <div class="row" id="opinie">
    <div class="col-sm-4">
      <div class="card">
        <img src="img/opinia1.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Jan Kowalski</h5>
          <p class="card-text">Samolot byl bardzo zadbany i czysty. Obsluga byla niezwykle uprzejma. Niemalym zaskoczeniem byl bogaty serwis pokladowy na niezwykle krotkiej trasie i to w trakcie pandemii! Poczestunek skladal sie z butelki wody, jagodzianki z lokalnej firmy cukierniczej, orzeszkow, zelkow.</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <img src="img/opinia2.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Andrzej Nowak</h5>
          <p class="card-text">
            With supporting text below as a natural lead-in to additional content. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus ex nobis totam, cumque exercitationem recusandae aspernatur omnis minima nihil labore aperiam expedita quae minus architecto, vero consequatur.</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <img src="img/patryk.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Patryk Plizga</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus ex nobis totam, cumque exercitationem recusandae aspernatur omnis minima nihil labore aperiam expedita quae minus architecto, vero consequatur.</p>
        </div>
      </div>
    </div>
  </div>












  <div class="container" id="featured-3">
    <div class="row g-5 mx-auto" id="dlaczego">
      <h2 class="pb-2 border-bottom">Dlaczego my</h2>
      <div class="feature col-md-4">
        <h2>Bezpieczne i wygodne loty</h2>
        <p>Nasze samoloty należą do światowej czołówki. Dysponujemy najnowszymi osiągnięciami współczesnego lotnictwo takimi jak Boeing 737, czy Туполев Ту-204. Z naszych usług skorzystali między innymi Patryk Plizga oraz Grzegorz Braun. Warto dodać, że wszyscy ciągle żyją oraz co najmniej jeden z nich zachwala nasze usługi.</p>
      </div>
      <div class="feature col-md-4">
        <h2>Konkurencyjne stawki</h2>
        <p>Oferujemy jedne z najbardziej konkurencyjnych w branży cen bez uszczerbku na jakości, obsłudze klienta i wysokich standardach bezpieczeństwa wymaganych przez naszych klientów.
          Dzięki naszym nowoczesnym latadełkom oraz naszej wykwalifikowanej kadrze, nasi klienci mogą być pewni, że korzystają z usługi o doskonałym stosunku jakości do ceny.</p>
      </div>
      <div class="feature col-md-4">
        <h2>Doświadczona załoga</h2>
        <p>Do kadry naszych pilotów należą tylko najlepsi, tacy ludzie jak Patryk Plizga - wielokrotny mistrz latania akrobacyjnego. Były pilot kamikaze. Podczas lotu usługiwać będą Ci atrakcyjne stewardessy. Jeżeli Ci się wielce poszczęści możesz trafić na samą Miss Medyni Głogowskiej - Patrycję Plizgę.</p>
      </div>
    </div>
  </div>
  <!-- <script>
    document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });
  </script> -->

  <br><br><br>


  <?php
  include "prefab/footer";
  ?>


</body>



</html>