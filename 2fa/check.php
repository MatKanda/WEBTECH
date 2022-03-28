<?php
require_once 'PHPGangsta/GoogleAuthenticator.php';
session_start();
require_once "../getConnection.php";
$connection = (new Database())->getConnection();
$stm = $connection->prepare("SELECT user.token FROM user WHERE user.login=?");
$stm->execute([$_SESSION["login"]]);
$results = $stm->fetchAll(PDO::FETCH_ASSOC);
//$secret = 'TE5T4XR5ST7IIHV2';
$secret=$results[0]["token"];

if (isset($_POST['code'])) {
    $code = $_POST['code'];

    $ga = new PHPGangsta_GoogleAuthenticator();
    $result = $ga->verifyCode($secret, $code);

    if ($result == 1) {
        echo $result;
    } else {
        echo 'Login failed';
    }
}
