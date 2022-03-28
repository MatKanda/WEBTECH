<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet">
</head>
<body>
<ul>
    <li><a href="http://147.175.98.72/Zadanie7/">Home</a></li>
    <li><a href="http://147.175.98.72/Zadanie7/info.php">Informácie</a></li>
    <li><a href="http://147.175.98.72/Zadanie7/stats.php">Štatistiky</a></li>
</ul>

<div id="city"></div><hr>

<div class="container">
    <div class="row">
        <div id="1" class="col">
        </div>
        <div id="2" class="col">
        </div>
        <div id="3" class="col">
        </div>
        <div id="4" class="col">
        </div>
        <div id="5" class="col">
        </div>
<!--        <div id="6" class="col">-->
<!--            <img id=img6" src="">-->
<!--        </div>-->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>

<?php
function getVisIpAddr() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
function getStateByIp($ip){
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    return $ipdat->geoplugin_countryName;
//    echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n";
//    echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
//    echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";
//    echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n";
//    echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n";
//    echo 'Timezone: ' . $ipdat->geoplugin_timezone;
}

function getCity($ip){
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    return $ipdat->geoplugin_city;
}

include "getConnection.php";
include "functions.php";
$connection=(new Database())->getConnection();
$vis_ip = getVisIPAddr();
loadVisitor($connection,$vis_ip,1);
getAllTimes($connection,1);
//echo 'User IP Address - ' . $_SERVER['REMOTE_ADDR'];

