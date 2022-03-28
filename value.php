<?php
include "getConnection.php";
$connection=(new Database())->getConnection();
if(isset($_POST["state"])){
    $stm = $connection->prepare("SELECT city,number FROM logins WHERE state=?");
    $stm->execute([$_POST["state"]]);
    $results=$stm->fetchAll();
//    var_dump($results);

    $output=[];
    for($i=0;$i<sizeof($results);$i++){
        array_push($output,$results[$i]["city"]);
        array_push($output,$results[$i]["number"]);
        }
    echo json_encode($output);
}
