<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link href="css/dashboard.css" rel="stylesheet">

  <script src="js/dashboard.js"></script>
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <?php include 'prefab/statystyki.php'; ?>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    function drawChartBagaze() {
      var data = google.visualization.arrayToDataTable([
        ['Typ', 'Ilost']
        <?php
        echo getBestBagaze();
        ?>
      ]);
      var options = {
        title: 'Najczesciej wybierane bagaze',
        is3D: true,
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
    function drawChartMiejsca() {
      var data = google.visualization.arrayToDataTable([
        ['Miejsce', 'Ilosc']
        <?php
        echo getBestMiejsca();
        ?>
      ]);

      var options = {
        title: 'Najczesciej wybierane kierunki podróży'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
      chart.draw(data, options);
    }
    function drawChartKlienci() {
      var data = google.visualization.arrayToDataTable([
        ['Klient', 'IleDal']
        <?php
        echo Top_5_klientow();
        ?>
      ]);

      var options = {
        title: 'Najbogatsi klienci',
        pieHole: 0.4,
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
      chart.draw(data, options);
    }
    function drawChartPensje() {
      var data = google.visualization.arrayToDataTable([
        ['Zarobki', 'Liczba']
        <?php
        echo getPracownicyZarobki();
        ?>
      ]);
      var options = {
        title: 'Dane wynagrodzeń pracownikow'
      };

      var chart = new google.visualization.BarChart(document.getElementById('piechart4'));
      chart.draw(data, options);
    }
  </script>


<script>


</script>



  <script>
    $(document).ready(function() {
      $("#lotniska_link").click(function() {
        loadTable('lotniska');
      });
      $("#loty_link").click(function() {
        loadTable('loty');
      });
      $("#samoloty_link").click(function() {
        loadTable('samoloty');
      });
      $("#bagaze_link").click(function() {
        loadTable('bagaze');
      });
      $("#uzytkownicy_link").click(function() {
        loadTable('uzytkownicy');
      });
      $("#bilety_link").click(function() {
        loadTable('bilety');
      });
      $("#pracownicy_link").click(function() {
        loadTable('pracownicy');
      });
      $("#glowne_statystyki_link").click(function() {
        loadTableOth('glowne_statystyki');
      });
      $("#pensje_pracownikow_link").click(function() {
        loadTableContentPensje('pensje_pracownikow');
      });
      $("#obrot_link").click(function() {
        loadTableContentObrot('obrot');
      });
      $(document).on('keypress', function(e) {
        if (e.which == 13) {
          var x = $(".active").text().trim().split(" ")[0].toLowerCase().replace(/\s+/g, '');;
          loadTableContentSearch(1, x);
        }
      });
    });
    loadTable('lotniska');
  </script>

  <style>
    .charts-main {
      margin: auto;
    }
  </style>




</head>


<body>

  <?php
  session_start();
  if (!isset($_SESSION['username']) || $_SESSION['typ_konta'] != 1) {
    header('Location: index.php');
  }
  ?>

  <script>
    function fixAddDate(){
      var now = new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0,16);
      document.getElementById("d_odlotu").min = now;
      document.getElementById("d_przylotu").min = now;
            $('#d_odlotu').change(function(){
                if($('#d_odlotu').val() < now){
                  document.getElementById("d_odlotu").value = now;
                }
                document.getElementById("d_przylotu").min = $('#d_odlotu').val();
                if($('#d_przylotu').val() < $('#d_odlotu').val() && $('#d_przylotu').val() != '')
                {
                document.getElementById("d_przylotu").value = $('#d_odlotu').val();
                }
            });
            $('#d_przylotu').change(function(){
              if($('#d_przylotu').val() < now){
                document.getElementById('d_przylotu').value = now;
              }
              if($('#d_przylotu').val() < $('#d_odlotu').val())
              {
                document.getElementById("d_przylotu").value = $('#d_odlotu').val();
              }
            });
            $('#m_odlotu').change(function(){
                if($('#m_odlotu').val() == $('#m_przylotu').val()){
                    document.getElementById('m_odlotu').selectedIndex = '-1';
                }
            });
            $('#m_przylotu').change(function(){
                if($('#m_odlotu').val() == $('#m_przylotu').val()){
                  document.getElementById('m_przylotu').selectedIndex = '-1';
                }
            });
    }
    function fixEditDate(){
      var now = new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0,16);
      document.getElementById("d_odlotu_edit").min = now;
      document.getElementById("d_przylotu_edit").min = now;
            $('#d_odlotu_edit').change(function(){
                if($('#d_odlotu_edit').val() < now){
                  document.getElementById("d_odlotu_edit").value = now;
                }
                document.getElementById("d_przylotu_edit").min = $('#d_odlotu_edit').val();
                if($('#d_przylotu_edit').val() < $('#d_odlotu_edit').val() && $('#d_przylotu_edit').val() != '')
                {
                document.getElementById("d_przylotu_edit").value = $('#d_odlotu_edit').val();
                }
            });
            $('#d_przylotu_edit').change(function(){
              if($('#d_przylotu_edit').val() < now){
                document.getElementById('d_przylotu_edit').value = now;
              }
              if($('#d_przylotu_edit').val() < $('#d_odlotu_edit').val())
              {
                document.getElementById("d_przylotu_edit").value = $('#d_odlotu_edit').val();
              }
            })
            $('#m_odlotu_edit').change(function(){
                if($('#m_odlotu_edit').val() == $('#m_przylotu_edit').val()){
                  document.getElementById('m_odlotu_edit').selectedIndex = '-1';
                }
            });
            $('#m_przylotu_edit').change(function(){
                if($('#m_odlotu_edit').val() == $('#m_przylotu_edit').val()){
                  document.getElementById('m_przylotu_edit').selectedIndex = '-1';
                }
            });
    }
  </script>

  <header id="sign_out" class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">WruumAir</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" id="search" type="text" placeholder="Szukaj" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="phpScripts/logout.php">Wyloguj</a>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a id="lotniska_link" class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                Lotniska
              </a>
            </li>
            <li class="nav-item">
              <a id="loty_link" class="nav-link" href="#">
                <span data-feather="file"></span>
                Loty
              </a>
            </li>
            <li class="nav-item">
              <a id="samoloty_link" class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Samoloty
              </a>
            </li>
            <li class="nav-item">
              <a id="bagaze_link" class="nav-link" href="#">
                <span data-feather="users"></span>
                Bagaze
              </a>
            </li>
            <li class="nav-item">
              <a id="uzytkownicy_link" class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Uzytkownicy
              </a>
            </li>
            <li class="nav-item">
              <a id="bilety_link" class="nav-link" href="#">
                <span data-feather="layers"></span>
                Bilety
              </a>
            </li>
            <li class="nav-item">
              <a id="pracownicy_link" class="nav-link" href="#">
                <span data-feather="layers"></span>
                Pracownicy
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span id="other">Raporty</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a id="glowne_statystyki_link" class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Glowne Statystyki
              </a>
            </li>
            <li class="nav-item">
              <a id="pensje_pracownikow_link" class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Dane wynagrodzen
              </a>
            </li>
            <li class="nav-item">
              <a id="obrot_link" class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Obrot Firmy
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main id="tabela" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


      </main>
    </div>
  </div>


</body>

</html>