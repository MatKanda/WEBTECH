<?php
include "getConnection.php";
$connection=(new Database())->getConnection();
$stm = $connection->prepare("SELECT city FROM logins");
$stm->execute();
$results=$stm->fetchAll();
$arr=[];
foreach ($results as $result){
    array_push($arr,$result["city"]);
}
echo json_encode($arr);