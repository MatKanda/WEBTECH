<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "getConnection.php";
$connection=(new Database())->getConnection();

$stm = "SELECT action,timestamp FROM user_actions WHERE lecture_id=? AND name=? AND surname=?";
$stm=$connection->prepare($stm);
$stm->execute([$_GET["lecture"],$_GET["name"],$_GET["surname"]]);
$result=$stm->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
//for($i=0;$i<sizeof($result);$i++){
//    echo  $result[$i]["action"]." ".$result[$i]["timestamp"]." ";
//}
