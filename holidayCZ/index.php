<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("../getConnection.php");
header('Content-Type: application/json');

$connection=(new Database())->getConnection();

$stm= $connection->prepare("SELECT den, CZsviatky FROM record");
$stm->execute();
$results=$stm->fetchAll(PDO::FETCH_ASSOC);

$output=[];
foreach ($results as $res){
    if ($res["CZsviatky"]!="")
        array_push($output,$res);
}
//var_dump($output);
echo json_encode($output);