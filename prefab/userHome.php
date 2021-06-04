<?php
session_start();


function convertToHoursMins($time, $format = '%02dh:%02dm')
{
  if ($time < 1) {
    return;
  }
  $hours = floor($time / 60);
  $minutes = ($time % 60);
  return sprintf($format, $hours, $minutes);
}


function prognoza($place)
{
  $apiKey = "36abd25b1ac7e386102a1140578a5467";
  $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $place . "&lang=en&units=metric&APPID=" . $apiKey;

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);

  curl_close($ch);
  $data = json_decode($response);
  $currentTime = time();
  return $data;
}



function upcomingFlights()
{
  include "../phpScripts/config2.php";
  $curs = oci_new_cursor($conn);
  $stid = oci_parse($conn, "begin ZBLIZAJACE_SIE_LOTY(:cursbv,'" . $_SESSION['username'] . "'); end;");
  oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
  oci_execute($stid);

  oci_execute($curs);
  $git_gut = 0;

  while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    $id = $row['ID_BILET'];
    $miasto_odlotu = $row['MIEJSCE_ODLOTU'];
    $miasto_przylotu = $row['MIEJSCE_PRZYLOTU'];
    $data_odlotu = $row['DATA_ODLOTU'];
    $data_przylotu = $row['DATA_PRZYLOTU'];
    $cena = $row['CENA'];
    $czas_lotu = $row['PRZEWIDYWANY_CZAS_LOTU'];
    $oplac = $row['CZY_OPLACONY'];
    makeCardUpcoming($miasto_odlotu, $miasto_przylotu, $data_odlotu, $data_przylotu, $cena, $czas_lotu, $id, $oplac, $git_gut);
    $git_gut++;
  }
  if ($git_gut == 0) {
    echo "<div class='alert alert-danger nic'><h1 style='text-align: center; transform: translate(0, 150%);' class='display-5'>Brak nadchodzących lotów</h1></div>";
  }


  oci_free_statement($stid);
  oci_free_statement($curs);
  oci_close($conn);
}

function lastFlights()
{
  include "../phpScripts/config2.php";
  $curs = oci_new_cursor($conn);
  $stid = oci_parse($conn, "begin ODBYTE_LOTY(:cursbv,'" . $_SESSION['username'] . "'); end;");
  oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
  oci_execute($stid);

  oci_execute($curs);
  $git_gut = 0;

  while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    $git_gut++;
    $miasto_odlotu = $row['MIEJSCE_ODLOTU'];
    $miasto_przylotu = $row['MIEJSCE_PRZYLOTU'];
    $data_odlotu = $row['DATA_ODLOTU'];
    $data_przylotu = $row['DATA_PRZYLOTU'];
    $cena = $row['CENA'];
    $czas_lotu = $row['PRZEWIDYWANY_CZAS_LOTU'];
    makeCardLast($miasto_odlotu, $miasto_przylotu, $data_odlotu, $data_przylotu, $cena, $czas_lotu);
  }
  if ($git_gut == 0) {
    echo "<div class='alert alert-danger nic'><h1 style='text-align: center; transform: translate(0, 175%);' class='display-5'>Brak historii lotów</h1></div>";
  }


  oci_free_statement($stid);
  oci_free_statement($curs);
  oci_close($conn);
}




function makeCardLast($miasto_odlotu, $miasto_przylotu, $data_odlotu, $data_przylotu, $cena, $czas_lotu)
{
  $photo = 'photos/' . strtolower($miasto_przylotu) . '.png';
  if (!file_exists('../' . $photo)) {
    $photo = 'photos/placeholder.png';
  }
  echo '<div class="col-sm-6 col-md-4 col-xs-12">
       <article class="card card-big mb15">
         <div class="card_img-wrap">
           <img src="' . $photo . '">
         </div>
         <div class="card_info">
           <div class="title-left-wrap">
             <h5>' . $miasto_odlotu . '</h5> <small> ' . $data_odlotu . ' </small>
           </div>
           <span class="icon-center-wrap"><i class="material-icons rotate90"></i><br><small>' . convertToHoursMins($czas_lotu) . '</small></span>
           <div class="title-right-wrap">
             <h5>' . $miasto_przylotu . '</h5> <small>' . $data_przylotu . '</small>
           </div>
         </div>
         <div class="card_pricelist">
           <div class="cost">
             <div class="logo-wrap"><img src="logo.png"></div>
             <div class="icon-wrap"><i class="material-icons">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small> </div>
             <div class="price-wrap"><var class="price"><span class="currency"><b>Cena</b></span></var></div>
             <div class="price-wrap"><var class="price"><span class="currency">PLN </span>' . $cena . '</var></div>
           </div>
         </div>
       </article>
     </div>';
}

function makeCardUpcoming($miasto_odlotu, $miasto_przylotu, $data_odlotu, $data_przylotu, $cena, $czas_lotu, $id, $oplac, $git_gut)
{
  $data = prognoza($miasto_przylotu);
  if ($miasto_przylotu == 'PARYZ')
    $data = prognoza('paris');
  $photo = 'photos/' . strtolower($miasto_przylotu) . '.png';
  if (!file_exists('../' . $photo)) {
    $photo = 'photos/placeholder.png';
  }
  echo '<div class="col-sm-6 col-md-4 col-xs-12">';
  if ($oplac) echo '<a onclick=drukuj("' . $id . '")>';
  else echo '<a onclick="pay(' . $id . ');">';
  echo '<article class="card card-big mb15">
         <div class="card_img-wrap">
           <img src="' . $photo . '">
         </div>
         <div class="card_info">
           <div class="title-left-wrap">
             <h5>' . $miasto_odlotu . '</h5> <small> ' . $data_odlotu . ' </small>
           </div>
           <span class="icon-center-wrap"><i class="material-icons rotate90"></i><br><small>' . convertToHoursMins($czas_lotu) . '</small></span>
           <div class="title-right-wrap">
             <h5>' . $miasto_przylotu . '</h5> <small>' . $data_przylotu . '</small>
           </div>
         </div>
         <div class="card_pricelist">
           <div class="cost">
             <div class="logo-wrap">
             <img src="http://openweathermap.org/img/w/';
              echo $data->weather[0]->icon;
              echo '.png" 
             
             
             
             class="weather-icon" />';
             $temp = $data->main->temp_max;
             echo round($temp, 1);

             echo ' °C
    
             </span>
             
             </div>
             <div class="icon-wrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="timer' . $git_gut . '"></span> <i class="material-icons">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small> </div>
             <div class="price-wrap"><var class="price"><span class="currency"><b>';
  if ($oplac) echo 'Opłacono';
  else echo 'Nie opłacono';
  echo '</b></span></var></div>
             <div class="price-wrap"><var class="price"><span class="currency">PLN </span>' . $cena . '</var></div>
           </div>
         </div>
       </article>';
  echo '</a>';
  echo '</div>';
}

?>
<!-- <div class="logo-wrap"><img src="logo.png"></div> -->


<!-- Flights -->
<div id="new" class="container xd">
  <h class='lot-heading'>Zbliżające się loty</h>
  <div class="row lot-border">
    <?php
    upcomingFlights();
    echo "<h style='margin-top:40px;' class='lot-heading'>Ostatnio odbyte loty</h>";
    lastFlights();
    ?>
  </div>
</div>