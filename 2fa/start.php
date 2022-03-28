<?php

require_once 'PHPGangsta/GoogleAuthenticator.php';
require_once "../getConnection.php";
session_start();
$connection=(new Database())->getConnection();


$websiteTitle = 'MyWebsite';

$ga = new PHPGangsta_GoogleAuthenticator();

$secret = $ga->createSecret();
//echo 'Secret is: '.$secret.'<br />';

echo "<h1 style='margin-left: 28%'>Please, scan this QR-code to your application</h1>";
$qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
echo '<br/><img style="margin-left: 40%; margin-top: 5%" src="'.$qrCodeUrl.'" />';

$myCode = $ga->getCode($secret);
//echo 'Verifying Code '.$myCode.'<br />';

//third parameter of verifyCode is a multiplicator for 30 seconds clock tolerance
$result = $ga->verifyCode($secret, $myCode, 1);

try{
    $stm = $connection->prepare("UPDATE user SET token=? WHERE user.login=?");
    $stm->execute([$secret,$_SESSION["login"]]);
}catch (PDOException $e){
    $e->getMessage();
}

//if ($result) {
//    echo 'Verified';
//} else {
//    echo 'Not verified';
//}



echo "<br><br><a href=https://wt72.fei.stuba.sk/Zadanie3/2fa/login.php>Go to Login<a/>";
