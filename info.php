<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie7</title>
    <link href="css/info.css" rel="stylesheet">
</head>
<body>
<ul>
    <li><a href="http://147.175.98.72/Zadanie7/">Home</a></li>
    <li><a href="http://147.175.98.72/Zadanie7/info.php">Informácie</a></li>
    <li><a href="http://147.175.98.72/Zadanie7/stats.php">Štatistiky</a></li>
</ul>

<h1>Informácie o používateľovi</h1><hr>
<div id="ip"></div>
<div id="city"></div>
<div id="state"></div>
<div id="capital"></div>
<div id="coordinates"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/info.js"></script>
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
////////////urobit alert na puzitie ip
/// //
/// //
/// //
include "getConnection.php";
include "functions.php";
$connection=(new Database())->getConnection();
$vis_ip = getVisIPAddr();
loadVisitor($connection,$vis_ip,2);
getAllTimes($connection,2);