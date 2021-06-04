<?php
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
$data = prognoza('Kioto');
?>

<!doctype html>
<html>

<head>
    <title>Forecast Weather using OpenWeatherMap with PHP</title>
</head>

<body>
    <div class="report-container">
        <div class="weather-forecast">
            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
        </div>
    </div>
</body>

</html>