<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("../getConnection.php");
header('Content-Type: application/json');

$connection=(new Database())->getConnection();

if(isset($_POST["date"]) && isset($_POST["name"])){
    $stm= $connection->prepare("SELECT id,den FROM record");
    $stm->execute();
    $results=$stm->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result){
        if($result["den"]==intval($_POST["date"])){
            $id=$result["id"];
            break;
        }
    }

    $stm= $connection->prepare("SELECT SKd FROM record WHERE id=?");
    $stm->execute([$id]);
    $result=$stm->fetch(PDO::FETCH_ASSOC);
    $names=$result["SKd"];
    if($names=="")
        $names=$_POST["name"];
    else
        $names=$names.", ".$_POST["name"];

    try {
        $stm = "UPDATE record SET SKd=? WHERE id=?";
        $stmt= $connection->prepare($stm);
        $stmt->execute([$names, $id]);
    }catch (PDOException $e) {
        echo json_encode($e->getMessage());
    }
    echo json_encode("Updated");
}
