<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "getConnection.php";
$connection = (new Database())->getConnection();

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $stm = $connection->prepare("SELECT * FROM user WHERE login=?");
    $stm->execute([$_POST["login"]]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    if(password_verify($_POST["password"],$user["password"])==true){
        $_SESSION["login"]=$user["login"];
        header("location:2fa/login.php");
    }else
        header("location:index.php");

}
?>

