<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("../getConnection.php");
include "methods.php";
header('Content-Type: application/json');

$connection=(new Database())->getConnection();

if(isset($_GET["date"])){
    getNameByDate($connection);
}

if(isset($_GET["name"]) && isset($_GET["state"])){
    getDateByNameState($connection);
}
