<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "getConnection.php";
include "functions.php";
$connection=(new Database())->getConnection();

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

function getLng($ip){
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    return $ipdat->geoplugin_longitude;
}
function getLat($ip){
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    return $ipdat->geoplugin_latitude;
}

$vis_ip = getVisIPAddr();

$state=getStateByIp($vis_ip);

$city=getCity($vis_ip);

$cityLat=getLat($vis_ip);

$cityLng=getLng($vis_ip);

loadVisitor($connection,$vis_ip,3);
getAllTimes($connection,3);

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie7</title>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />


    <link rel="stylesheet" href="css/leaflet-routing-machine.css">

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="js/leaflet-routing-machine.js"></script>
    <script src="js/Control.Geocoder.js"></script>
    <link href="css/stats.css" rel="stylesheet">

</head>
<body>
    <ul>
        <li><a href="http://147.175.98.72/Zadanie7/">Home</a></li>
        <li><a href="http://147.175.98.72/Zadanie7/info.php">Informácie</a></li>
        <li><a id="Try" href="http://147.175.98.72/Zadanie7/stats.php">Štatistiky</a></li>
    </ul>
    <h1>Štatistiky</h1><hr>

    <table>
        <thead>
            <tr>
                <th>State</th>
                <th>Flag</th>
                <th>Total logins</th>
            </tr>
        </thead>
        <?php createTableBody($connection,$vis_ip,$state,$city) ?>
    </table>


    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
        </div>
    </div>

    <div id="mapid">
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/stats.js"></script>
    <script>
        setTimeout(()=>createMap(),2000);
    </script>

</body>
</html>