<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie3</title>
    <link rel="stylesheet" href="css/mainPage.css">
</head>
<?php
include_once ("getConnection.php");
include ("indexHTML.php");
session_start();

if(isset($_POST["2fa"]) && isset($_POST["verified"])){
    sessionToDB();
}

if (isset($_SESSION["login"]) && !empty($_SESSION["login"])) {
    upperLogged();
} else {
    upperNotLogged();
}


?>

<br>

<!--<a href=login.php>Login</a><br>-->
    <br><br>

<footer>
    Created by: Matúš Kanda
</footer>
</body>
</html>
